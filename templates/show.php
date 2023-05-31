<?php
/**@var $params */
if ($params) :
    $item=$params['item'];?>
<div class="col-4 border border-2 rounded-1 border-white me-3 d-flex justify-content-center">
    <form method="post" action="/?action=update">
        <div class="box text-center">
            <img class="img mt-2 img-fluid" src="assets/img/<?php echo $item->getImage();?>">
            <h6 class="text-center mt-2"><?php echo $item->getName();?></h6>
            <h6 class="text-center mt-2"><?php echo $item->getCode();?></h6>
            <h6 class="text-center"><?php echo $item->getPrice();?></h6>
            <div class="input-group mb-2">
                <input class="" type="number" name="amount" min="1" value="<?php echo $item->getAmount();?>">
                <input type="number" name="id" hidden value="<?php echo $item->getId();?>">
            </div>
            <input type="submit" class="btn btn-outline-info"></input>
        </div>
    </form>
</div>

<?php endif;
