<div class="row orderDetails">
    <h3>Order #<?php echo $orderId; ?></h3>
    <p><span class="tag">Email:</span> <?php echo $order['email']; ?></p>
    <p><span class="tag">Phone:</span> <?php echo $order['phone']; ?></p>
    <p><span class="tag">Date:</span> <?php echo $order['date']; ?></p>
    <p><span class="tag">Total:</span> <?php echo $order['total']; ?></p>
    <?php echo $order['instructions'] ? '<p><span class="tag">Instructions</span> ' . $order['instructions'] . '</p>' : '' ; ?>
</div>
<div class="row orderDetailsTable">
    <table class="twelve">
        <thead>
            <tr>
                <td>Product</td>
                <td>Qty</td>
                <td>Price</td>
            </tr>
        </thead>
        <tbody>
            <?php for($i=0; $i<count($order['details']); $i++): ?>
                <tr>
                    <td><?php echo $order['details'][$i]['name'];?></td>
                    <td><?php echo $order['details'][$i]['qty'];?></td>
                    <td><?php echo $order['details'][$i]['price'];?></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>