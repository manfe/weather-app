# weather-app
This project aims to collect temperatures from different weather providers and let the users see just the average.

# Consuming External API
To consume an external weather API need to use the following code:

```
$p = new Partner("Weather", 'https://0945b870-c60e-4e13-9659-d4b766a6d832.mock.pstmn.io/temperatures', 'json');
$client = new Client();
$city = "Amsterdam";

$api = new ConsumeTemperaturesAPI($p, $client, $city);
$apiResponse = $api->getData();

var_dump($apiResponse);
```

If the partner is a new one, need to add a parser to normalize the response to base json format to be easiser to make calculations with them.

see formatted files on `tests/mocks/responses/formatted_*_temps.json`

# Development Server
To start symphony dev server just need to run: `php -S localhost:8000 -t public`

## Testing the API
To check how the API is returning the results you can check the routes: 

* [http://localhost:8000/v1/temperatures/amsterdam/20180620/fahrenheit](http://localhost:8000/v1/temperatures/amsterdam/20180620/fahrenheit)
* [http://localhost:8000/v1/temperatures/amsterdam/20180620/celsius](http://localhost:8000/v1/temperatures/amsterdam/20180620/celsius)

Celsius is default, if no scale param is provided:

* [http://localhost:8000/v1/temperatures/amsterdam/20180620](http://localhost:8000/v1/temperatures/amsterdam/20180620)


# Running Tests
Before run the test suite you need startup the local server and configure the BASE_URL variable into `phpunit.xml`
This provide us the ability to run a dev and test server separately if necessary.

To run the tests you should execute the command: `php bin/phpunit`