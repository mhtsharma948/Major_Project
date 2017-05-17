<nav>
    <div class="nav-wrapper cyan lighten-2">
        <a href="index.php" class="brand-logo">ProjArch</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href='signin.php'>Sign In</a></li>
            <li><a href='signup_page.php'>Sign Up</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href='signin.php'>Sign In</a></li>
            <li><a href='signup_page.php'>Sign Up</a></li>
        </ul>
    </div>
</nav>
<script>
    $(document).ready(function(){ $(".button-collapse").sideNav(); });
</script>