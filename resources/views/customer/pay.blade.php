@extends('layouts.master') 
@section('title', 'Payment')
@section('content')

    <section class="container pt-5">
        <div class="container p-5 border-2 rounded-3 border-primary">
            <div class="row gx-4 gx-lg-5 align-items-center">

                <form id="pay" action="{{ route('pay.post') }}" method="post">
                    @csrf

                    <div class="form-group pb-4">
                        <label for="product_name" class="pb-2">Cardholder Full Name</label>
                        <input class="form-control" name="name" id="card-holder-name" type="text">
                    </div>

                    <input name="paymentMethodId" id="paymentMethodId" value="" type="text" hidden>
                    
                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element"></div>
                    
                    <a class="btn btn-primary mt-4" onClick="hold()" id="card-button">
                        Process Payment
                    </a>
                </form>

              
            </div>
        </div>
    </section>
    @push('script')

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

    @endpush
@endsection
