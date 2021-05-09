<form id=f name=f action="/customer/paymentsresponse" method=post>
    <table id=Table1
           cellspacing=0 cellpadding=3 width=100% border=0>
        <tr>
            <td align=right width=30%>Merchant
                ID:
            </td>
            <td><input size=50 id=result value=00008029INVOUR202105021600558230092100000000010005 name=result ></td>
        </tr>
        <tr>
            <td align=right
                width=30%>Card Number:
            </td>
            <td><input size=50 id=response value=00
                       name=response></td>
        </tr>
        <tr>
            <td align=right width=30%>Expiry Date:</td>
            <td><input size=50
                       id=authCode value=008029 name=authCode></td>
        </tr>
        <tr>
            <td align=right
                width=30%>CVV2:
            </td>
            <td><input size=50 id=invoiceNo value=INVOUR20210508191606 name=invoiceNo></td>
        </tr>
        <tr>
            <td align=right
                width=30%>credential:
            </td>
            <td><input size=50 id=PAN value=8230 name=
                PAN></td>
        </tr>
        <tr>
            <td align=right>Invoice No:</td>
            <td><input size=50 id=expiryDate
                       value=0921 name=expiryDate></td>
        </tr>
        <tr>
            <td align=right>Amount:</td>
            <td><input
                    size=50 id=amount value=000000000100 name=amount></td>
        </tr>
        <tr>
            <td
                align=right>secretCode:
            </td>
            <td><input size=50 id=ECI value=05
                       name=ECI></td>
        </tr>
        <tr>
            <td align=right>Security Method:</td>
            <td><input type=text
                       id=securityKeyRes name=securityKeyRes value="hE3c1Irq308822Yrk7IJXbUabls=">
            </td>
        </tr>
        <tr>
            <td
                align=right>securityKeyReq(Hash Value):
            </td>
            <td><input size=50 id=hash
                       name=hash value="hE3c1Irq308822Yrk7IJXbUabls=">
                </button>
            </td>
        </tr>
        <input size=50 type=hidden id=secretString
               name=secretString>
        <tr>
            <td><input size=50 type=submit value=Submit></td>
        </tr>
    </table>
</form>
