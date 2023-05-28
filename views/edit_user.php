<?php
/** @var $this \app\core\View */
/** @var $user \app\models\User */

$this->title = 'Edit User';

?>

<h1>Edit User</h1>

<form action="/admin/edit-user?id=<?php echo $user->id; ?>" method="post">
    <div>
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" name="firstname" value="<?php echo $user->firstname; ?>">
    </div>
    <div>
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo $user->lastname; ?>">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $user->email; ?>">
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo $user->username; ?>">
    </div>

    <!-- Add more fields as needed -->

    <button type="submit">Save</button>
</form>
