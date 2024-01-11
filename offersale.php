
            <!DOCTYPE html>
            <html >
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="Token sale page">

                <title>BitCore V3 (BTX) token sale</title>


                <style>

                    body {font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; color: #FFFFFF; background-color: #000000; font-size: 16px; font-weight: 400;}

                    h1 { font-size: 24px; font-weight: 700;}
                    h2 { font-size: 22px; font-weight: 500;}

                    .small {
                        font-size: 12px;
                    }

                    .err {
                        color: red;
                    }

                    .green {
                        color: green;
                    }

                    .blue {
                        color: blue;
                    }

                    * {
                        box-sizing: border-box;
                    }

                    a {
                        color: #FFFFFF;
                        text-decoration: none;
                    }

                    a:hover {
                        color: #C0C0C0;
                    }

                    .clickable {
                        cursor: pointer;
                    }

                    .clickable:hover {
                        color: #C0C0C0;
                    }

                    button {
                        background-color: #283747;
                        border: none;
                        border-radius: 2px;
                        color: white;
                        padding: 5px 20px;
                        text-align: center;
                        text-decoration: none;
                        font-size: 16px;
                        display: inline-block;
                        margin: 4px 2px;
                        cursor: pointer;
                    }

                    button:hover {
                        background-color: #008000;
                    }

                    button[disabled] {
                        opacity: 0.6;
                        cursor: not-allowed;
                    }

                    hr {
                        margin: 20px;
                        border: 0;
                        border-top: 1px dashed;
                    }

                    input {
                        text-align: center;
                        font-size: 18px;
                        background-color: #000000;
                        color: #FFFFFF;
                        border:1px solid;
                        max-width: 100%;
                    }

                    progress[value] {
                        /* Reset the default appearance */
                        -webkit-appearance: none;
                        appearance: none;
                        width: 250px;
                        height: 20px;
                    }

                </style>

                <script>
                    var contractAddressSale = "0xc018951013402C3Ed6B015292174c7E7F8783d0d";
                    var usenet = "56";
                </script>

            </head>

            <body>

            <div style="text-align: center">
                <button id="connect" style="font-size: 12px">Connect</button> <button class="switch" id="switch" style="font-size: 12px; display: none;">Use Metamask!</button>
                <span id="nometamask" class="err" style="display: none">Please install Metamask first...</span>
                <div class="network small"><span id="curnet"><span class="err">Please use DApp browser/extension (e.g. <a target="_blank" href="https://metamask.io">Metamask</a>)</span></span> <span id="myAddr"></span>
                    <span id="referred" style="display:none"><br>Referrer: <span id="referrer"></span></span></div>
            </div>

            <div style="text-align: center">
                <h1>Token info</h1>
                <h2><span id="tokenName">BitCore V3</span> (<span class="tokenSymbol">BTX</span>)</h2>
                <p><a target="_blank" href="https://bscscan.com/token/0x52931d231EEE0d9059e09A489E6e77Bff45a38BE" id="tokenAddress">0x52931d231EEE0d9059e09A489E6e77Bff45a38BE</a><br>
                    <span class="small err">Do not send BNB or <span class="paytokenSymbol">USDT</span> to the token contract!</span></p>
            <!-- Reserved in case you want to show decimals and total supply: Decimals <span id="#tokenDecimals">18</span> Total supply <span id="#tokenSupply"></span>-->
                <p><button id="addToken" style="text-align: center">Add to Metamask</button> <button id="copyToken" style="text-align: center">Copy address</button></p>
            </div>

            <hr>

            <div style="text-align: center">
                <h1>Token sale status</h1>
                <h1>
                    <span id="finished" style="display:none" class="status green">Finished</span>
                    <span id="active" style="display:none" class="status green">Active</span>
                    <span id="addtokens" style="display:none" class="status err"><br>Ask token sale admin to approve token sale contract or check tokens balance in the admin's wallet!</span>
                </h1>
                <p><progress id="progress" value="0" max="100" style="width: 70%"></progress></p>
                <p>Raised: <span id="raised"></span> of <span class="hardcap"></span> <span class="paytokenSymbol">USDT</span></p>
                <p>Tokens sold: <span id="sold"></span> of <span class="saleqty"></span> <span class="tokenSymbol">BTX</span></p>
                <p>Remaining: <span id="toraise"></span> <span class="paytokenSymbol">USDT</span> (~ <span id="unsold"></span> <span class="tokenSymbol">BTX</span>)</p>
            </div>
            <hr>

            <div style="text-align: center">
                <h1>Buy tokens</h1>
                <p>1 <span class="tokenSymbol">BTX</span> = <span class="price"></span> <span class="paytokenSymbol">USDT</span></p>
                <p><input type="number" id="buyAmount" value="0" min="0"> <span class="paytokenSymbol">USDT</span></p>
                <p>You get: <span id="get">0</span> <span class="tokenSymbol">BTX</span></p>
                <p>
                    <button id="apprBtn" style="text-align: center">(1/2) Approve <span class="paytokenSymbol">USDT</span></button>
                    <button id="buyBtn" style="text-align: center; display: none">(2/2) Pay <span class="paytokenSymbol">USDT</span></button>
                </p>
                <p id="lowBalance" class="err" style="display: none">Not enough <span class="paytokenSymbol">USDT</span> in your wallet!</p>
                <p>In my wallet: <span id="myTokens"></span> <span class="tokenSymbol">BTX</span> | <span id="myPayTokens"></span> <span class="paytokenSymbol">USDT</span></p>
            </div>
            <hr>

            <div style="text-align: center">
                <h1>Token sale information</h1>
                <p>Accepted currency: <span class="paytokenSymbol">USDT</span></p>
                <p>Hardcap: <span class="hardcap"></span> <span class="paytokenSymbol">USDT</span> (~ <span class="saleqty"></span> <span class="tokenSymbol">BTX</span>)</p>
                <p>Price: 1 <span class="tokenSymbol">BTX</span> = <span class="price"></span> <span class="paytokenSymbol">USDT</span></p>
            </div>

            <script src='https://dappbuilder.org/js/jquery-3.6.0.min.js' type="text/javascript" charset="utf-8"></script>
            <script src='https://dappbuilder.org/js/ethers-5.0.umd.min.js' type="text/javascript" charset="utf-8"></script>
            <script src='https://dappbuilder.org/bsc/tokensaleusd/js/tokensale.ui.js' type="text/javascript" charset="utf-8"></script>

            </body>
            </html>
        
