<form id=f name=f action=https://uattds2.pbebank.com/PGW/Pay/Process method=post>
    <table id=Table1
           cellspacing=0 cellpadding=3 width=100% border=0>
        <tr>
            <td align=right width=30%>Merchant
                ID:
            </td>
            <td><input size=50 id=merID value=3300000106 name=merID></td>
        </tr>
        <tr>
            <td align=right
                width=30%>Card Number:
            </td>
            <td><input size=50 id=PAN value=4553580010301129
                       name=PAN></td>
        </tr>
        <tr>
            <td align=right width=30%>Expiry Date:</td>
            <td><input size=50
                       id=expiryDate value=1215 name=expiryDate></td>
        </tr>
        <tr>
            <td align=right
                width=30%>CVV2:
            </td>
            <td><input size=50 id=CVV2 value=133 name=CVV2></td>
        </tr>
        <tr>
            <td align=right
                width=30%>credential:
            </td>
            <td><input size=50 id=credential value=Y name=
                credential></td>
        </tr>
        <tr>
            <td align=right>Invoice No:</td>
            <td><input size=50 id=invoiceNo
                       value=MERCHANTPAGEPAYMAC04 name=invoiceNo></td>
        </tr>
        <tr>
            <td align=right>Amount:</td>
            <td><input
                    size=50 id=amount value=000000000400 name=amount></td>
        </tr>
        <tr>
            <td
                align=right>secretCode:
            </td>
            <td><input size=50 id=secretCode value=320C78176C20
                       name=secretCode></td>
        </tr>
        <tr>
            <td align=right>Security Method:</td>
            <td><input type=hidden
                       id=securityMethod name=securityMethod><input size=50 id=sha1 type=radio value=SHA1
                                                                    name=method>SHA1<br><input size=50 id=sha2
                                                                                               type=radio name=method
                                                                                               checked>SHA2
            </td>
        </tr>
        <tr>
            <td
                align=right>securityKeyReq(Hash Value):
            </td>
            <td><input size=50 id=securityKeyReq
                       name=securityKeyReq>&nbsp;<button title="Compute Hash" name=hashButton id=hashButton type=button
                                                         onclick=getHash()>Hash
                </button>
            </td>
        </tr>
        <input size=50 type=hidden id=secretString
               name=secretString>
        <tr>
            <td align=right>BankName: *Optional for fraud check</td>
            <td><input size=50
                       id=bankName name=bankName></td>
        </tr>
        <tr>
            <td align=right>BankCountry: *Optional for fraud
                check
            </td>
            <td><input size=50 id=bankCountry name=bankCountry></td>
        </tr>
        <tr>
            <td align=right>Post
                URL (card holder will see this page):
            </td>
            <td><input size=50 id=postURL
                       value=https://uattds2.pbebank.com/PGW/Pay/Show name=postURL></td>
        </tr>
        <tr>
            <td
                align=right>&nbsp;
            </td>
            <td><input size=50 type=submit value=Submit></td>
        </tr>
    </table>
</form>
