<section class="container">
    <h1 class="mb-1">Reset Password</h1>

    <form action="actions/auth-update-password.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET['user'];?>">
        <input type="hidden" name="token" value="<?= $_GET['token'];?>">
        <div class="form-row">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-row">
            <label for="password_confirm">Confirm Password</label>
            <input type="password" id="password_confirm" name="password_confirm" class="form-control">
        </div>
        <button type="submit" class="button" class="btn text-light align-self-center main-dark-bg m-3">Update</button>
    </form>
</section>
