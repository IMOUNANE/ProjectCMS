<h1>Write article</h1>

<form method="post" enctype="multipart/form-data" class="form-group d-flex flex-column col-6  bg-light p-5">
    <input  class="col-sm-10" type="text" name="author" placeholder="Auteur" id="postAuthor"
           value="<?= \Controller\SecurityController::getLoggedUser()->getFirstName(); ?>" disabled/> <br/>
    <input class="col-sm-10"  type="text" name="title" placeholder="titre"id="postTitle" required/> <br/>
    <textarea name="content" placeholder=" description" id="postContent" required></textarea> <br/>

    <label for="fileUpload">Fichier:</label>
    <input  class="col-sm-10" type="file" name="image" id="fileUpload"> <br/>

    <input  class="col-sm-10" type="submit" value="Post Article"/>
</form>