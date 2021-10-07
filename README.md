

## A basic e-commence project build upon laravel , livewire , tailwind and alpinejs

Its consist of shopping cart management, multiple payment gateway integration, admin penal to manage products orders refund etc..


Front end is built by alpine js and tailwindcss. use livewire for ajax , skeleton loading etc..
since this is just the starting point for the e-commence app, below features may be added in the future

- add a coupon and product rating.
- integrate a third api for products delivery and calculate delivery fee (currently no delivery fee) based on the address chosen
- send user notification such as refund success via sms or email

## A couple design pattern used
- Strategy pattern, this pattern is useful when we have different vendor or driver, and then we want to interchange switch them in run time

example: 

when we refund an order based on the different payment gateway, we want to change then in run time.

- Adaptor pattern, this pattern just a wrapper, 

example:

I have multiple payment vendor, each sdk contains different method so for refund maybe call refundorder in paypal , and in stripe maybe call refundaapi so its very hard for us, we want both vendor confirm the to same api.
so I made stripepayment and paypalpayment class , pass the sdk obejct, so we can design our payment interface


- Decorator pattern, this pattern just extending some default behavior by passing the original implementation as object to a different class,

And finally open close principle



