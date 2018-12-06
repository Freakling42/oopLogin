<div id="loginFormWrap">
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
</div>
<div id="registerUserFormWrap">
    <h1>Registrer ny bruger</h1>
    <form action="member.php" method="post">
        <table id="userRegisterForm" cellpadding="10" cellspacing="0">
            <tr>
                <td>Brugernavn</td>
                <td><input type="text" name="username" value="" />*</td>
            </tr>
            <tr>
                <td>Kodeord</td>
                <td><input type="password" name="password" value="" />*</td>
            </tr>
            <tr>
                <td>Gentag kodeord</td>
                <td><input type="password" name="password2" value="" />*</td>
            </tr>            
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" value="" />*</td>
            </tr>
            <tr>
                <td>Fornavn</td>
                <td><input type="text" name="firstname" value="" /></td>
            </tr>

            <tr>
                <td>Efternavn</td>
                <td><input type="text" name="lastname" value="" /></td>
            </tr>

            <tr>
                <td>adresse</td>
                <td><input type="text" name="adress" value="" /></td>
            </tr>

            <tr>
                <td>Postnummer</td>
                <td><input type="text" name="postal" value="" /></td>
            </tr>

            <tr>
                <td>By</td>
                <td><input type="text" name="city" value="" /></td>
            </tr>        

            <tr>
                <td colspan="2" align="right">
                    <input type="submit" name="register_user" value="Registrer">
                </td>
            </tr>
        </table>
    </form>
</div>    