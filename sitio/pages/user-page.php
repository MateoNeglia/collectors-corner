<?php
$user = new Collector\Models\User();
$purchases = (new Collector\Models\Purchase())->getByUserId($authentication->getUser()->getUserId());
?>
<section class="container">

    <h2 class="mb-1"><?= $authentication->getUser()->getName() ?>'s Page</h2>

    <p class="mb-1">This is your profile page.</p>
    <dl>
        <dt>User Name</dt>
        <dd><?= $authentication->getUser()->getName() ?></dd>
        <dt>User Email</dt>
        <dd><?= $authentication->getUser()->getEmail() ?></dd>
        <dt>User Role</dt>
        <dd><?= getUserBadge($authentication->getUser()->getUserRole()) ?></dd>        
    </dl>    
    <hr>
    <h3>Your Purchases</h3>
    <?php
    if($purchases != null):
    ?>
            <ul>
            <?php
            foreach($purchases as $purchase):
            ?>
                    
                    <li> <b><?= specialChatConv($purchase->getName());?></b> Quantity: <?= specialChatConv($purchase->getProductQuantity());?> Price: <?= specialChatConv($purchase->getPrice());?></li>                
        
            <?php
            endforeach;
            ?>
            </ul>
    <?php
    else:
    ?>  
    <p>You don't have any purchases yet</p>
    <?php
    endif;
    ?>
    <form action="panel/actions/auth-log-out.php" method="post">
        <button type="submit" class="btn text-light align-self-center main-dark-bg"><?= $authentication->getUser()->getEmail() ?> (Log Out)</button>
    </form>
    
</section>
