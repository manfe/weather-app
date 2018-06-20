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