TODO
- Support gopay tokenization
- Controller to cancel / refund order.
- Throw error when status code >= 400
- Get token for credit card payment
- Refund. Supported only for credit_card payment method. Banks which support this method are BNI, Mandiri, and CIMB.
- Direct Refund. Only supported for GoPay, QRIS, ShopeePay, and Credit Card payment methods. Currently for Credit Card payment method, Midtrans only supports BCA, MAYBANK, and BRI banks.

Other validation check
- For BCA VA, limit the customer names (first_name and last_name), to only 30 characters.
- Please avoid using vertical line (`|`) for Alfamart payment type.
- item_details is required for Akulaku and Kredivo payment type.
- Subtotal (item price multiplied by quantity) of all the item details needs to be exactly same as the gross_amount inside the transaction_details object.


# Usage

```
php artisan vendor:publish --provider="Gradints\LaravelMidtrans\MidtransServiceProvider" --tag=config
```

```
php artisan vendor:publish --provider="Gradints\LaravelMidtrans\MidtransServiceProvider" --tag=action
```

## Create transaction

```php
class PaymentGateway extends Midtrans
{
    private $paymentMethod;
    
    public function __construct(ShopOrder $order) {
        parent::__construct();

        $this->setTransaction($order->invoice_number, $order->payment_cash, $order->items);
        $this->setCustomer($order->user->name, $order->user->email)

        $this->paymentMethod = $this->getPaymentMethod($order->payment_method_id);
    }
    
    private function getPaymentMethod(int $id, array $data)
    {
        if ($id === 1) {
            return new PermataBank();
        } else if ($id === 50) {
            return new KlikBCA($data['user_id']);
        }

        throw InvalidPaymentMethodException;
    }

    public function submit()
    {
        return $this->createApiTransaction($this->paymentMethod);
    }
}
```

```php
$paymentGateway = new PaymentGateway($order);

<!-- using API -->
$paymentGateway->submit()

<!-- Using Snap -->
$paymentGateway->createSnapTransaction();
```


## Update payment status

```php
// config/midtrans.php

'config.midtrans.endpoints.payment_notification'
```
