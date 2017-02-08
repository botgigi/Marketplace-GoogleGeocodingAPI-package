[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/GoogleGeocodingAPI/functions?utm_source=RapidAPIGitHub_GoogleGeocodingFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)


# GoogleGeocodingAPI Package
Geocode and reverse geocode any address or region.
* Domain: google.com
* Credentials: apiKey

## How to get credentials: 
0. Go to [Google Developers Console](https://console.developers.google.com/?authuser=1);
1. Select a project, or create a new one.
2. Press **Continue** to activate API key.
3. In the sidebar on the left, select **Credentials**.
4. If your project has no API key for the server, create it now - **Add credentials > API key > Server key**;


## GoogleGeocodingAPI.addressToCoordinates
Convert a free form address to a set of coordinates (latitude, longitude).

| Field  | Type  | Description
|--------|-------|----------
| apiKey| credentials| The API key obtained from Google APIs.
| address| String| The exact address that you want to geocode, in the format used by the respective country's postal service.


## GoogleGeocodingAPI.getAddressComponents
Convert a free form address string to an object with it's different properties (street number, route, country, etc...).

| Field  | Type  | Description
|--------|-------|----------
| apiKey| credentials| The API key obtained from Google APIs.
| address| String| The exact address that you want to geocode, in the format used by the respective country's postal service.


## GoogleGeocodingAPI.coordinatesToAddress
Convert a location's coordinates on the map to an address string.

| Field    | Type  | Description
|----------|-------|----------
| apiKey  | credentials| The API key obtained from Google APIs.
| latitude | String| The latitude find the place
| longitude| String| The longitude find the place


