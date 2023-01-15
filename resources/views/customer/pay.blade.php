<form id="pay" action="{{ route('pay.post') }}" method="post">
    @csrf
    <input name="name" id="card-holder-name" type="text">
    <input name="paymentMethodId" id="paymentMethodId" value="" type="text">
    
    <!-- Stripe Elements Placeholder -->
    <div id="card-element"></div>
    
    <a onClick="hold()" id="card-button">
        Process Payment
    </a>
</form>

<script src="https://js.stripe.com/v3/"></script>
 
<script>
    const stripe = Stripe('pk_test_51MQUXaGgszRKSJ20T2t1sdaBfZ2X2Q5c6sM6Pf9HhORqKdCwShxOZtrEbMw4FBAyVuRjh3NLy5aTSSkktBpwoNlu00G1c6TDGv');
 
    const elements = stripe.elements();
    const cardElement = elements.create('card');
 
    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    const delay = ms => new Promise(res => setTimeout(res, ms));

    const hold = async () => {
        await delay(5000);
        document.getElementById("pay").submit();
    };

    cardButton.addEventListener('click', async (e) => {

        await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
            name: cardHolderName.value,
            },
        })
        .then(function(result) {
            var payid = result.paymentMethod.id;
            document.getElementById('paymentMethodId').value = payid;
        });

    });
</script>