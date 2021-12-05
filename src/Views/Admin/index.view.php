<h1>Mon Compte</h1>

<?php if (\Vendor\App\MessageTrigger::hasMessage()) : ?>
    <?= \Vendor\App\MessageTrigger::getMessage(); ?>
<?php endif; ?>

<form action="/update-user" method="post" class="form-group d-flex flex-column col-6  bg-light p-5">
    <label for="userFirstName" class="col-sm-2 col-form-label col-form-label-sm">First Name</label>
    <div><input  class="col-sm-10" type="text" name="userFirstName" id="userFirstName"
           value="<?= \Controller\SecurityController::getLoggedUser()->getFirstName(); ?>" required/></div> <br/>

    <label for="userLastName" class="col-sm-2 col-form-label col-form-label-sm">Last Name</label>
    <div><input class="col-sm-10"  type="text" name="userLastName" id="userLastName"
           value="<?= \Controller\SecurityController::getLoggedUser()->getLastName(); ?>" required/></div> <br/>

    <label for="userEmail" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
    <div><input  class="col-sm-10" type="email" name="userEmail" id="userEmail"
           value="<?= \Controller\SecurityController::getLoggedUser()->getEmail(); ?>" disabled required/></div> <br/>

    <label for="userRole" class="col-sm-2 col-form-label col-form-label-sm">Is Admin ?</label>
    <div><input class="col-sm-10"  type="checkbox" name="userRole" id="userRole"
           value="isAdmin" <?= \Controller\SecurityController::getLoggedUser()->isAdmin() ? 'checked' : ''; ?>/></div> <br/>

    <label for="userPassword" class="col-sm-2 col-form-label col-form-label-sm">Password</label>
    <div><input class="col-sm-10"  type="password" name="userPassword" id="userPassword" required/></div> <br/>

    <label for="userCheckPassword" class="col-sm-2 col-form-label col-form-label-sm">Verify Password</label>
    <div><input class="col-sm-10"  type="password" name="userCheckPassword" id="userCheckPassword" required/></div> <br/>
    <div><input class="col-sm-10"  type="submit" value="Update Infos"/></div>
</form>