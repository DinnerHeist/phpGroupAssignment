<?php
    $staff_name = $_SESSION['name'];
    $position = $_SESSION['position'];

    if (isset($_POST['search']))
        $_SESSION['customer_accounts_task'] = 'search';
    else if (isset($_POST['approve']))
        $_SESSION['customer_accounts_task'] = 'approve';

    $task = isset($_SESSION['customer_accounts_task']) ? $_SESSION['customer_accounts_task'] : 'search';

    $name = "localhost";
    $username = "root";
    $password = "";
    $database = "group_assignment";

    $sqli = new mysqli($name, $username, $password, $database);
    if ($sqli->connect_error)
        die("Connection failed: $sqli->connect_error");

    $records = array();

    if (isset($_POST['search_id'])) {
        $customer_id = $_POST['customer_id'];

        $stmt = $sqli->prepare('SELECT Title, Name, Email, Phone, Company, Country,
            PostalCode, City, State, Address, customers.Status AS Status, customers.Comments AS Comments, Approved
            FROM customers LEFT JOIN (
                SELECT approvals.CustomerID AS CustomerID, approvals.Approved AS Approved FROM approvals
                INNER JOIN (
                    SELECT CustomerID, MAX(DateTime) AS MaxDateTime FROM approvals
                    GROUP BY CustomerID
                ) AS a
                ON a.CustomerID=approvals.CustomerID AND a.MaxDateTime=approvals.DateTime
            ) AS b
            ON customers.CustomerID=b.CustomerID
            WHERE customers.CustomerID=?');
        $stmt->bind_param('i', $customer_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        $record = $result->fetch_assoc();
        if ($record) {
            $record['CustomerID'] = $customer_id;
            $records[] = $record;
        }
    } else if (isset($_POST['search_keyword'])) {
        $keyword = "%{$_POST['keyword']}%";

        $stmt = $sqli->prepare('SELECT customers.CustomerID AS CustomerID, Title, Name, Email, Phone, Company, Country,
            PostalCode, City, State, Address, customers.Status AS Status, customers.Comments AS Comments, Approved
            FROM customers
            LEFT JOIN (
                SELECT approvals.CustomerID AS CustomerID, approvals.Approved AS Approved FROM approvals
                INNER JOIN (
                    SELECT CustomerID, MAX(DateTime) AS MaxDateTime FROM approvals
                    GROUP BY CustomerID
                ) AS a
                ON a.CustomerID=approvals.CustomerID AND a.MaxDateTime=approvals.DateTime
            ) AS b
            ON customers.CustomerID=b.CustomerID
            WHERE customers.CustomerID LIKE ? OR
                Title LIKE ? OR
                Name LIKE ? OR
                Email LIKE ? OR
                Phone LIKE ? OR
                Company LIKE ? OR
                Country LIKE ? OR
                PostalCode LIKE ? OR
                City LIKE ? OR
                State LIKE ? OR
                Address LIKE ? OR
                customers.Status LIKE ? OR
                customers.Comments LIKE ?');
        $stmt->bind_param('issssssssssss', $keyword, $keyword, $keyword, $keyword, $keyword,
            $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        while ($record = $result->fetch_assoc())
            $records[] = $record;
    } else if (isset($_POST['approval'])) {
        $customer_id = $_POST['customer_id'];
        $status = $_POST['status'];
        $comments = trim($_POST['comments']);

        $stmt = $sqli->prepare('SELECT Status, Comments FROM customers WHERE CustomerID=?');
        $stmt->bind_param('i', $customer_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        $record = $result->fetch_assoc();
        // If at either status or comments is changed
        if (strtoupper($status) !== $record['Status'] || $comments !== $record['Comments']) {
            $stmt = $sqli->prepare('INSERT INTO approvals (ApprovalID, StaffName, CustomerID, DateTime, Status, Comments, Approved)
                VALUES (NULL, ?, ?, DEFAULT, ?, ?, DEFAULT)');
            $stmt->bind_param('siss', $staff_name, $customer_id, $status, $comments);
            $stmt->execute();
            $stmt->close();
        }
    } else if (isset($_POST['approve_status'])) {
        $approval_id = $_POST['approval_id'];

        $stmt = $sqli->prepare('UPDATE approvals INNER JOIN customers ON approvals.CustomerID=customers.CustomerID
            SET approvals.Approved=true, customers.Status=approvals.Status, customers.Comments=approvals.Comments
            WHERE ApprovalID=?');
        $stmt->bind_param('i', $approval_id);
        $stmt->execute();
        $stmt->close();
    }

    $approvals = array();
    if ($position === 'manager') {
        $result = $sqli->query('SELECT * FROM approvals WHERE Approved=false');
        while ($record = $result->fetch_assoc())
            $approvals[] = $record;
    }

    $sqli->close();
?>
