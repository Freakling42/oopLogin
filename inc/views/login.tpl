{if !empty($alertTekst)}<p id="alertTekst">{$alertTekst}</p>{/if}
<h1>Login</h1>
<form action="member.php" method="post">
    <table id="loginForm" cellpadding="10" cellspacing="0">
        <tr>
            <td>Brugernavn</td>
            <td><input type="text" name="username" value="" /></td>
        </tr>

        <tr>
            <td>Password</td>
            <td><input type="password" name="password" value="" /></td>
        </tr>

        <tr>
            <td colspan="2" align="right">
                <input type="submit" name="log_in" value="log in">
            </td>
        </tr>
    </table>
</form>