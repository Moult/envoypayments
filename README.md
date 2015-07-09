# envoypayments

This is a PHP library to help you talk to the EnvoyPayments API.

It's so tiny it's probably not even worth using.

If you have any ideas on how to bloat it up feel free to send a PR.

```
$ composer require moult/envoypayments:dev-master --prefer-dist
```

```
<?php

include 'vendor/autoload.php';

$client = new \Moult\Envoypayments\Client('7847b08b123f7f3ecf84e133ec635fc989d42b26');

try 
{
    $pay = $client->request('post', 'charges', [
        'amount' => '2.00',
        'currency' => 'AUD',
        'customer' => [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'dion@thinkmoult.com',
            'payment_source' => [
                'gateway_id' => '559e129d90f5d99a05afbaae',
                'card_name' => 'John Doe',
                'card_number' => '4111111111111111',
                'expire_month' => '01',
                'expire_year' => '17',
                'card_cvv' => '123'
            ]
        ]
    ]);
}
catch (\Exception $e)
{
    $r = $e->getResponse();
    throw new \Exception('A fatal transaction error occured - '.$r->getStatusCode().' '.$r->getBody()->getContents());
}
```
