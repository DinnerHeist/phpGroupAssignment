<table>
    <tbody>
        <form action="customer_accounts_module.php" method="post">
            <tr>
                <td>Customer ID:</td>
                <td><input type="text" name="customer_id" required></td>
                <td><input type="submit" name="search_id" value="Search"></td>
            </tr>
        </form>
        <form action="customer_accounts_module.php" method="post">
            <tr>
                <td>Keyword:</td>
                <td><input type="text" name="keyword"></td>
                <td><input type="submit" name="search_keyword" value="Search"></td>
            </tr>
        </form>
    </tbody>
</table>

<p>Customer Records:</p>

<table id="records">
    <thead>
        <tr>
            <th>CustomerID</th>
            <th>Title</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Company</th>
            <th>Country</th>
            <th>PostalCode</th>
            <th>City</th>
            <th>State</th>
            <th>Address</th>
            <th>Status</th>
            <th>Comments</th>
            <th>Change Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($records as $record) {
        ?>
        <tr>
            <td><?php echo $record['CustomerID']; ?></td>
            <td><?php echo $record['Title']; ?></td>
            <td><?php echo $record['Name']; ?></td>
            <td><?php echo $record['Email']; ?></td>
            <td><?php echo $record['Phone']; ?></td>
            <td><?php echo $record['Company']; ?></td>
            <td><?php echo $record['Country']; ?></td>
            <td><?php echo $record['PostalCode']; ?></td>
            <td><?php echo $record['City']; ?></td>
            <td><?php echo $record['State']; ?></td>
            <td><?php echo $record['Address']; ?></td>
            <form action="customer_accounts_module.php" method="post">
                <input type="hidden" name="customer_id" value="<?php echo $record['CustomerID']; ?>">
                <td>
                    <select name="status" <?php if ($record['Approved'] === 0) echo 'disabled'; ?>>
                        <option value="trusted" <?php if ($record['Status'] === 'TRUSTED') echo 'selected'; ?>>Trusted</option>
                        <option value="untrusted" <?php if ($record['Status'] === 'UNTRUSTED') echo 'selected'; ?>>Untrusted</option>
                    </select>
                </td>
                <td>
                    <textarea name="comments" rows=4 
                        <?php if ($record['Approved'] === 0) echo 'disabled'; ?>
                        ><?php echo $record['Comments']; ?></textarea>
                </td>
                <td>
                    <?php
                        if (is_null($record['Approved']) || $record['Approved']) {
                    ?>
                    <input type="submit" name="approval" value="Request for Approval">
                    <?php
                        } else {
                            echo 'Waiting for Approval';
                        }
                    ?>
                </td>
            </form>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>