<div></div>
<?php
/** @var $params */
    if($params): ?>
<?php foreach ($params['items'] ?? [] as $item): ?>
            <div class="col-2 border border-2 rounded-1 border-white me-3 d-flex justify-content-center">
                <div class="box text-center">
                    <img class="img mt-2" width="32px" height="32px" src="assets/img/<?php echo $item->getImage()?>">
                    <h6 class="text-center mt-2"><?php echo $item->getName();?></h6>
                    <h6 class="text-center mt-2"><?php echo $item->getCode();?></h6>
                    <h6 class="text-center"><?php echo $item->getPrice().' ';?>zł</h6>
                    <h6 class="text-center">Zostało: <?php echo $item->getAmount();?></h6>
                    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true): ?>
                        <a class="btn btn-outline-info" href="/?action=show&id=<?php echo $item->getId();?>">siema</a>
                    <?php endif; ?>
                </div>
            </div>
<?php endforeach ?>


    <?php endif; ?>

