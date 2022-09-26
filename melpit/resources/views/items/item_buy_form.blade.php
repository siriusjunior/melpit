@extends('layouts.app')

@section('title')
  {{$item->name}} | 商品購入
@endsection

@section('content')
  <script src="https://js.pay.jp/v2/pay.js"></script>
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2 bg-white">
        <div class="row mt-3">
          <div class="col-8 offset-2">
            @if (session('message'))
              <div class="alert alert-{{ session('type', 'success') }}" role="alert">
                {{ session('message') }}
              </div>
            @endif
          </div>
        </div>
        <!-- ./row mt-3 -->
        @include('items.item_detail_panel', [
        'item' => $item
        ])
        <div class="row">
          <div class="col-8 offset-2">
            <div class="card-form-alert alert alert-danger" role="alert" style="display: none"></div>
            <div class="form-group mt-3">
              <label for="number-form">カード番号</label>
              <div id="number-form" class="form-control"><!-- ここにカード番号入力フォームが生成されます --></div>
            </div>
            <!-- ./form-group mt-3 -->
            <div class="form-group mt-3">
              <label for="expiry-form">有効期限</label>
              <div id="expiry-form" class="form-control"><!-- ここに有効期限入力フォームが生成されます --></div>
            </div>
            <!-- ./form-group mt-3 -->
            <div class="form-group mt-3">
              <label for="cvc-form">セキュリティコード</label>
              <div id="cvc-form" class="form-control"><!-- ここにCVC入力フォームが生成されます --></div>
            </div>
            <!-- ./form-group mt-3 -->
          </div>
          <!-- ./col-8 offset-2 -->
        </div>
        <!-- ./row -->
        <div class="row mt-3 mb-3">
          <div class="col-8 offset-2">
            <button class="btn btn-secondary btn-block">購入</button>
          </div>
        </div>
        <!-- ./row mt-3 mb-3 -->
        <form id="buy-form" method="POST" action="{{route('item.buy', [$item->id])}}">
          @csrf
          <input type="hidden" id="card-token" name="card-token">
        </form>
      </div>
      <!-- ./col-8 offset-2 bg-white -->
    </div>
    <!-- ./row -->
  </div>
  <!-- ./container -->
  <script>
    var payjp = Payjp('{{config("payjp.public_key")}}')
    var elements = payjp.elements()
    var numberElement = elements.create('cardNumber')
    var expiryElement = elements.create('cardExpiry')
    var cvcElement = elements.create('cardCvc')
    numberElement.mount('#number-form')
    expiryElement.mount('#expiry-form')
    cvcElement.mount('#cvc-form')
  </script>
@endsection