<?php
$user = new Collector\Models\User();
$users = $user->getAll();
$purchases = (new Collector\Models\Purchase())->getAll();
?>
<section class="container">
    <h2 class="mb-1">Main Administration Panel</h2>

    <p>From here you can manage the main contents of the site.</p>
    <h3>Registered Users</h3>    
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User Email</th>
            <th scope="col">User Name</th>
            <th scope="col">User Last Name</th>
            <th scope="col">Nickname</th>
            <th scope="col">User Role</th>            
        </tr>
        </thead>
        <tbody>
    <?php
    foreach($users as $user):
    ?>
        <tr>
            <td><?= $user->getUserId();?></td>
            <td><?= $user->getEmail();?></td>
            <td><?= specialChatConv($user->getName()) == null ? "NO DATA" : specialChatConv($user->getName());?></td>
            <td><?= specialChatConv($user->getLastName())  == null ? "NO DATA" : specialChatConv($user->getLastName());?></td>
            <td><?= specialChatConv($user->getNickName())  == null ? "NO DATA" : specialChatConv($user->getNickName());?></td>
            <td><?= specialChatConv(getUserBadge($user->getUserRole()));?></td>
        </tr>
    <?php
    endforeach;
    ?>
        </tbody>
    </table>
    <h3>Current Purchases</h3>
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">Product ID</th>
            <th scope="col">User ID</th>
            <th scope="col">User Name</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Quantity</th>
            <th scope="col">Product Price</th>            
        </tr>
        </thead>
        <tbody>
    <?php
    foreach($purchases as $purchase):
    ?>
        <tr>
            <td><?= $purchase->getPurchaseId();?></td>
            <td><?= $purchase->getUserFk();?></td>
            <td><?= $user->getById($purchase->getUserFk())->getName();?></td>
            <td><?= specialChatConv($purchase->getName());?></td>
            <td><?= specialChatConv($purchase->getProductQuantity());?></td>
            <td><?= specialChatConv($purchase->getPrice());?></td>            
        </tr>
    <?php
    endforeach;
    ?>
        </tbody>
    </table>
</section>
