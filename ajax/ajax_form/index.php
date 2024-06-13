<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Asynchronous Form</title>
  <style>
    #result {
      display: none;
    }
    .error {
      border: 1px solid red;
    }
    #spinner {
      display: none;
    }
  </style>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

  <div id="measurements">
    <p>Enter measurements below to determine the total volume.</p>
    <form id="measurement-form" action="process_measurements.php" method="POST">
      Length: <input type="text" name="length" /><br />
      <br />
      Width: <input type="text" name="width" /><br />
      <br />
      Height: <input type="text" name="height" /><br />
      <br />
      <input id="html-submit" type="submit" value="Submit" />
      <input id="ajax-submit" type="button" value="Ajax Submit" />
    </form>
  </div>

  <div id="spinner" class="spinner-border" role="status">
    <span class="sr-only"></span>
  </div>

  <div id="result">
    <p>The total volume is: <span id="volume"></span></p>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function() {
      var resultDiv = $('#result');
      var volume = $('#volume');

      function showSpinner() {
        var spinner = $('#spinner');
        spinner.show();
      }

      function hideSpinner() {
        var spinner = $('#spinner');
        spinner.hide();
      }

      function displayErrors(errors) {
        var inputs = $('input');
        inputs.each(function() {
          var input = $(this);
          if(errors.indexOf(input.attr('name')) >= 0) {
            input.addClass('error');
          }
        });
      }

      function clearErrors() {
        var inputs = $('input');
        inputs.each(function() {
          $(this).removeClass('error');
        });
      }

      function postResult(value) {
        volume.html(value);
        resultDiv.show();
      }

      function clearResult() {
        volume.html('');
        resultDiv.hide();
      }

      function calculateMeasurements() {
        clearResult();
        clearErrors();

        showSpinner();

        var form = $('#measurement-form');
        var action = form.attr('action');
        var formData = form.serialize(); // Serialize the form data

        $.ajax({
          url: action,
          type: 'POST',
          data: formData,
          success: function(response) {
            hideSpinner();
            var json;
            try {
              json = JSON.parse(response);
            } catch (e) {
              console.error('Failed to parse JSON response: ' + response);
              alert('An error occurred. Please try again.');
              return;
            }

            if (json.errors) {
              displayErrors(json.errors);
            } else {
              console.log('Result: ' + json.volume);
              postResult(json.volume);
            }
          },
          error: function(xhr, status, error) {
            console.error('Error: ' + error);
          }
        });
      }

      $('#ajax-submit').on('click', calculateMeasurements);
    });
  </script>
</body>
</html>