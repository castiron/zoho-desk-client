# Zoho Desk Client

This ia a ligthweight PHP client for the [Zoho Desk API](https://desk.zoho.com/DeskAPIDocument). The goal is to handle 
 the wee little administrative sauce needed to interact with the API directly. Under the hood this uses 
 [Httpful](https://github.com/nategood/httpful). 

## Implementation Completeness

This implementation is in beta and should not be considered complete. Currently it should work to POST and GET resources 
 via the API. Other interactions have not been tested/proven. Pull requests are welcomed.

## Usage

```php
$options = [
    'token' => 'my-zoho-dest-api-token',
    'orgId' => 'my-zoho-desk-orgId',
];
$client = new ZohoDeskClient($options);
$res = $client->get('tickets/1892000000143237', [
    'include' => 'contacts,products',
])->send();
```
