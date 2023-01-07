<p>決済ページへリダイレクトします。</p>
<script src="https://js.stripe.com/v3/"></script>
<script>
    const publicKey = '{{ $publickey }}'
    const stripe = Stripe(publicKey)
    window.onload = function() {
        // ここで決済ページへリダイレクト
        // $session = \Stripe\Checkout\Session::create([
        //     'payment_method_types' => ['card'],
        //     'line_items' => [$lineItems],
        //     'mode' => 'payment',
        //     'success_url' => route('user.items.index'),
        //     'cancel_url' => route('user.cart.index'),
        // ]);
        // のところで自動的にセッションIDが生成される

        stripe.redirectToCheckout({
            sessionId: '{{ $session->id }}'
        }).then(function(result) {
            // エラー時の処理
            // cartのcancelで在庫を戻す処理を行う
            window.location.href = '{{ route('user.cart.cancel') }}';
        });
    }
</script>
