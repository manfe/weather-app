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

# Frontend
To avoid creating a new app just to show the frontend working and consuming the API, I added the index.html file to the public folder, there is possible to have a idea how it's working. (the UX is not 100%, I had a little problem with the sliders, so check the gif for usage :D). Also I didn't had more time to add a select for cities, but it was going to update the URL request.

After the server is started up access the link (http://localhost:8000/index.html) to see a Vue.JS app consuming the API.

![Usage](https://im.ezgif.com/tmp/ezgif-1-8fcadbbc19.gif)

