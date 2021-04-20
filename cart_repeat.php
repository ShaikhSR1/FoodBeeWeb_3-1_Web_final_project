<?php

function cartElement ($food_img){
    $element = "
        <form action="cart.php" method="POST" class="cart-items">
            <div class="border rounded">
                                <div class="row bg-white">
                                    <div class="col-md-3 pl-0">
                                        <img src="" alt="" class="">
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="pt-2">Product Name</h3>
                                        <h4 class="text-secondary">Seller:dailytution</h4>
                                        <h3 class="pt-2">price</h3>
                                        <button type="submit" class="btn btn-warning">Save for latter </button>
                                        <button type="submit" class="btn btn-danger mx-2">Remove</button>
                                    </div>
                                    <div class="col-md-3 py-5">
                                        <button type="button" class="btn bg-light border rounded-circle"><i class="fas fa-minus"></i></button>
                                        <input type="text" value="1" class="form-control w-25 d-inline">
                                        <button type="button" class="btn bg-light border rounded-circle"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
    
    ";
    echo $element;
}























?>