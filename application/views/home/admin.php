<h1>
    E Voting System - Admin Panel !!!
    <?php echo "<br>Welcome Back ".$this->session->userdata('name'); ?>
</h1>
<br>
<form action="/home">
    <input type="submit" value="HOME" />
</form>
<form action="login/log_out">
    <input type="submit" value="Log Out " />
</form>

<form action="/poll/create">
    <input type="submit" value="New Poll" />
</form>
<form action="/user">
    <input type="submit" value="User Management" />
</form>
<form action="/Poll">
    <input type="submit" value="Election Management" />
</form>
<form action="/Reports">
    <input type="submit" value="Report Management" />
</form>



