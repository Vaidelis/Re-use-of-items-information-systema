@extends('layouts.app')
@section('content')




    <body style="margin-top: 0px;">

    <div class="container">
        <div style="text-align: center">
            <h4 class="">Pasirinktos paslaugos skelbimo informacija</h4>
            <hr>
            @Auth
                @if(Auth::user()->id == $service->user_id)
                    <!-- Button HTML (to Trigger Modal) -->
                    <a href="#modalCenter" role="button" data-bs-toggle="modal"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Ištrinti</button></a>
                        @if(Auth::user()->id == $service->user_id)
                            <a href="{{route('serviceedit', $service->id)}}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Redaguoti</button></a>
                        @endif
                        @endif
                    @endauth
                    <a  href="{{ url('personalAnnouncement') }}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Atgal</button></a>
            @auth
                @if(Auth::user()->id != $service->user_id)
                    <a  href="{{route('rememberservice', $service->id)}}"><button class="btn3 btn-primary btn-xlr" <?php if($remember != null){ ?> hidden <?php }?> style="cursor: pointer;">Įsiminti</button></a>

                    <form method="POST" action="{{route('serviceforget', $service->id)}}" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button class="btn3 btn-primary btn-xl" <?php if($remember == null){ ?> hidden <?php }?> type="submit">Pamiršti</button>
                    </form>
                    @endif
            @endauth
            <hr>
            @if ($message = Session::get('success'))
                <center>
                    <div style="width: 70%;height: 50px;text-align: center;" class="alert alert-success">
                        <span style="text-align: center">{{ $message }}</span>
                    </div>
                </center>
            @endif
        </div>

        <?php $counter = 0; $ifcan = 0; ?>
        <div class="row">
        <div class="col-lg-5 col-md-12 col-12">
            @foreach($portphotos as $image)

                    @if($counter == 0 && $image->name != null)
                        <img class="img-fluid pb-1" src="{{asset($image->path)}}" alt="{{ $image->path }}" id="MainImg" style="width: 440px; height: 430px; object-fit: cover;" />
                        <?php $counter = $counter + 1; $ifcan = $ifcan + 1;?>
                        <div class="small-img-group">
                            <div class="small-img-col">
                                <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" style="width: 100px; height: 100px; object-fit: cover;" />
                            </div>
                            @elseif($image->name != null)
                                <div class="small-img-col">
                                    <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" style="width: 100px; height: 100px; object-fit: cover;" />
                                </div>
                            @endif

                            @endforeach
                        </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            <p class="name"><b>{{ $service->name }}</b></p>
            <div class="hairline"></div>

            <div class="left-info" style="text-align: left;">


            </div>
            <p>Skelbimo savininkas  - <b>{{ $name }}</b></p>
            <p>Skelbimo kaina  - <b>{{ $service->price }}</b> €</p>
            <div class="hairline"></div>
            <a style="position: center"  href="{{route('portfolioshow', $service->user_id)}}">Tiekėjo informacija</a>
            @auth
            @if(Auth::user()->id != $service->user_id)
                <a href="{{route('createmessage', $service->user_id)}}" class="block w-full p-2 text-center text-black bg-indigo-400 hover:bg-indigo-600">Parašyti žinute</a>
            @endif
            @endauth
            <p class="infoHeader">Aprašymas</p>
            <p class="info"><b>{{ $service->information }}</b><p>
                @auth
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="#modalBuy" role="button" data-bs-toggle="modal"><button <?php if($bought != null || Auth::User()->id == $service->user_id){ ?> disabled <?php }?> class="btn3 btn-primary btn-xl" >Pirkti</button></a>
                @endauth
        </div>

            <script>
                var MainImg = document.getElementById('MainImg');
                var smallimg = document.getElementsByClassName('img-fluid');
                var all = 5;

                for ( var i = 0; i < 12; i++ ) (function(i){
                    smallimg[i].onclick = function (){
                        MainImg.src = smallimg[i].src;
                    }
                })(i);
            </script>

            <!-- Plugin JavaScript -->
            <script src="/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for this template -->
            <script src="/js/creative.min.js"></script>


            <!-- Modal HTML -->
            <div id="modalCenter" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-confirm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="icon-box">
                                <span style="font-size: 35px" class="material-icons">&#xE5CD;</span>
                            </div>
                            <h4 class="modal-title">Ar tikrai norite ištrinti?</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Ar tikrai norite ištrinti šį skelbimą? Po ištrynimo skelbimo nebebus.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Atšaukti</button>
                            <a href={{route('servicedestroy', $service->id)}}><button style="width:25px" class="btn btn-danger">Ištrinti</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal buy HTML -->
            <div id="modalBuy" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-confirm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Daikto įsigyjimas</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div id="paypal-button-container"> </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
            <script src="https://www.paypal.com/sdk/js?client-id=AV8fUiAHK7J8KOabpygdfCxRRxs4aS3vleP6EY6yFKGgWEHOlcDippe4p5tJpq-F_qiWt-sOk7IeShD0&currency=USD"></script>

            <script>
                paypal.Buttons({
                    // Sets up the transaction when a payment button is clicked
                    createOrder: (data, actions) => {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: '{{$service->price}}' // Can also reference a variable or function
                                }
                            }]
                        });
                    },
                    // Finalize the transaction after payer approval
                    onApprove: (data, actions) => {
                        return actions.order.capture().then(function(orderData) {
                            // Successful capture! For dev/demo purposes:
                            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                            const transaction = orderData.purchase_units[0].payments.captures[0];
                            actions.redirect("{{route('servicebuy', [ 'id' => $service->id, 'userid' => $service->user_id])}}");
                            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details1`);



                            // When ready to go live, remove the alert and show a success message within this page. For example:
                            // const element = document.getElementById('paypal-button-container');
                            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                            // Or go to another URL:  actions.redirect('thank_you.html');
                        });
                    }
                }).render('#paypal-button-container');
            </script>
    </body>
@endsection
