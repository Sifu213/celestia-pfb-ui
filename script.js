function check_balance() {
  $.get("get_balance.php", function(response) {
    if (response.success) {
      alert("Node blance : " + response.amount + " TIA");
    } else {
      alert(response.message);
    }
  }, 'json');
};

function get_block_header() {
 $.get("get_block_header.php", function(response) {;
   if (response.success) {
     alert("Actual block header commit hash : " + response.commitHash);
   } else {
     alert(response.message);
   }
  }, 'json');
};

function generateNamespaceIdAndData() {
	generateNamespaceId()
	generateData()
}

function generateNamespaceId() {
    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }

    function intToHex(intValue) {
        return intValue.toString(16).padStart(16, '0');
    }

    const maxInt = Math.pow(2, 32) - 1;
    const randomInt = getRandomInt(maxInt);
    const namespaceId = intToHex(randomInt);

    const namespaceIdInput = document.getElementById('namespace_id');
    namespaceIdInput.value = namespaceId;
}

function generateData() {
    function getRandomString(length) {
        let result = '';
        for (let i = 0; i < length; i++) {
            const randomAsciiCode = Math.floor(Math.random() * 62);
            const charCode = randomAsciiCode < 26
                ? randomAsciiCode + 65       // Uppercase letters (A-Z)
                : randomAsciiCode < 52
                    ? randomAsciiCode + 71   // Lowercase letters (a-z)
                    : randomAsciiCode + 48;  // Digits (0-9)
            result += String.fromCharCode(charCode);
        }
        return result;
    }

    function stringToHex(str) {
        return Array.from(str, c => c.charCodeAt(0).toString(16).padStart(2, '0')).join('');
    }

    const randomStringLength = Math.floor(Math.random() * 21) + 10; // Generates a random length between 10 and 30
    const randomString = getRandomString(randomStringLength);
    const hexEncodedData = stringToHex(randomString);

    const dataInput = document.getElementById('data');
    dataInput.value = hexEncodedData;
}



function submitPFBTransaction() {

 // Display the loader
  $("#loader").show();
  $("#submit-button").prop("disabled", true);

  var namespace_id = $("#namespace_id").val();
  var data = $("#data").val();

  // AJAX call to PHP function
  $.ajax({
    url: "send_pfb_transaction.php",
    type: "POST",
    data: { "namespace_id": namespace_id, "data": data },
    dataType: "json",
    success: function(response) {
      if (response.success) {
        // Data extraction if succes
        var height = JSON.parse(response.json_data).height;
        var txhash = JSON.parse(response.json_data).txhash;
	var shares = JSON.parse(response.json_data).namespaced_shares;
	$("#height-label").text(height);
	var txhash_link = document.getElementById("txhash_link");
	txhash_link.href = "https://testnet.mintscan.io/celestia-incentivized-testnet/txs/" + txhash;
	txhash_link.textContent = txhash;
	$("#shares-label").text(shares);

	console.log("Height : " + height);
        console.log("TxHash : " + txhash);
	console.log("Shares : " + shares);

	} else {
        alert("Error sending the tw : " + response.message);
      }
    },
    error: function() {
      alert("Error when calling the PHP function !");
    },
    complete: function() {
      // Hide the loader
      $("#loader").hide();
      $("#submit-button").prop("disabled", false);
      $("#results").show();
    }
  });
}
