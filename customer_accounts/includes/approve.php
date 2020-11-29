<?php
    if (count($approvals) > 0) {
?>

<table>
    <thead>
        <tr>
            <th>ApprovalID</th>
            <th>StaffName</th>
            <th>CustomerID</th>
            <th>DateTime</th>
            <th>Status</th>
            <th>Comments</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($approvals as $record) {
        ?>
        <tr>
            <td><?php echo $record['ApprovalID']; ?></td>
            <td><?php echo $record['StaffName']; ?></td>
            <td><?php echo $record['CustomerID']; ?></td>
            <td><?php echo $record['DateTime']; ?></td>
            <td><?php echo $record['Status']; ?></td>
            <td><?php echo $record['Comments']; ?></td>
            <td>
                <form action="customer_accounts_module.php" method="post">
                    <input type="hidden" name="approval_id" value="<?php echo $record['ApprovalID']; ?>">
                    <input type="submit" name="approve_status" value="Approve">
                </form>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<?php
    } else {
?>

<p>No status updates to approve.</p>

<?php
    }
?>
