@component('mail::message')

    # Order Shipped

    Your order has been shipped!

    @component('mail::button', ['url' => 'https://laravel.com/docs/8.x/mail#plain-text-emails', 'color' => 'success'])
        View Order
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}

@endcomponent
