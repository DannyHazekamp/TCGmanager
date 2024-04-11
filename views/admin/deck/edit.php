<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h1 class="display-5 mb-4">Edit deck</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" value="<?php echo $deck->name ?>" class="form-control <?php echo $deck->hasError('name') ? 'is-invalid' : '' ?>" id="name" placeholder="Enter name">
                    <div class="invalid-feedback">
                        <?php echo $deck->getError('name') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control <?php echo $deck->hasError('description') ? 'is-invalid' : '' ?>" name="description" id="description" rows="3" placeholder="Enter description"><?php echo $deck->description ?></textarea>
                    <div class="invalid-feedback">
                        <?php echo $deck->getError('description') ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>