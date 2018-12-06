<div id="eUserFormWrap">
    <h1>Rediger oplysninger</h1>
    <form action="member.php" method="post">
        <table id="userEditForm" cellpadding="10" cellspacing="0">
            <tr>
                <td>Brugernavn</td>
                <td>{$username}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{$email}</td>
            </tr>
            <tr>
                <td>Fornavn</td>
                <td><input type="text" name="firstname" value="{$firstname}" /></td>
            </tr>

            <tr>
                <td>Efternavn</td>
                <td><input type="text" name="lastname" value="{$lastname}" /></td>
            </tr>

            <tr>
                <td>adresse</td>
                <td><input type="text" name="adress" value="{$adress}" /></td>
            </tr>

            <tr>
                <td>Postnummer</td>
                <td><input type="text" name="postal" value="{$zipcode}" /></td>
            </tr>

            <tr>
                <td>By</td>
                <td><input type="text" name="city" value="{$city}" /></td>
            </tr>        

            <tr>
                <td colspan="2" align="right">
                    <input type="submit" name="edit_user" value="Gem mine ændringer">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="passFormWrap">
    <h1>Ændre kodeord</h1>
    <form action="member.php" method="post">
        <table id="userEditForm" cellpadding="10" cellspacing="0">
            <tr>
                <td>Kodeord</td>
                <td><input type="password" name="password" value="" /></td>
            </tr>

            <tr>
                <td>Gentag Kodeord</td>
                <td><input type="password" name="password2" value="" /></td>
            </tr>        

            <tr>
                <td colspan="2" align="right">
                    <input type="submit" name="edit_pass" value="Gem mine ændringer">
                </td>
            </tr>
        </table>
    </form>
</div>