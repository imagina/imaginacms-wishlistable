@extends('iprofile::frontend.layouts.master')


@section('title')
  {{trans("wishlistable::wishlistables.title.myWishlist")}}   | @parent
@stop


@section('profileTitle')
  {{trans("wishlistable::wishlistables.title.myWishlist")}}
@stop

@section('profileBreadcrumb')
  <x-isite::breadcrumb>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('wishlistable::wishlistables.title.myWishlist') }}</li>
  </x-isite::breadcrumb>
@endsection
@section('profileContent')


  <!-- preloader -->
  <div id="content_preloader" v-if="preloader">
    <div id="preloader"></div>
  </div>

  <div id="contentWishlist" class="row">
    <div class="col-lg-12  pb-5">
      <div id="cont_products" class="mt-4">

        <div class="table-responsive">
          <table class="table table-bordered table-shape">
            <thead>
            <tr>
              <th>{{ trans('wishlistable::wishlistables.table.image') }}</th>
              <th>{{ trans('wishlistable::wishlistables.table.item') }}</th>
              <th>{{ trans('wishlistable::wishlistables.table.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="wishlist in wishlists" v-if="wishlist.entity">
              <td>
                <a :href="wishlist.url">

                  <img v-if="" :src="wishlist.entity.mediaFiles.mainimage.relativeSmallThumb" :alt="wishlist.entity.name || wishlist.entity.title"
                       class="img-responsive img-fluid" style="width:100px;height:auto;">
                </a>

              </td>

              <td><a :href="wishlist.url"> @{{wishlist.entity.name || wishlist.entity.title}} </a></td>

              <td>

                <a title="Eliminar de la lista de deseos" @click="deleteWishlist(wishlist.id)"
                   class="cart text-primary cursor-pointer">
                  <i class="fa fa-trash" style="margin: 0 5px;"></i>
                </a>
              </td>
            </tr>
            <tr v-if="wishlists.length==0">
              <td class="text-center" colspan="4">{{ trans('wishlistable::wishlistables.messages.itemsNotFound') }}</td>
            </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>




@stop
@section('profileExtraFooter')
  @include('icommerce::frontend.partials.extra-footer')
@endsection
@section('scripts')
  @parent
  <script>
    /* =========== VUE ========== */
    const vue_index_commerce = new Vue({
      el: '#contentWishlist',
      data: {
        preloader: true,
        /*wishlist*/
        user: {!! $currentUser ? $currentUser->id : 0 !!},
        wishlists: [],
      },
      mounted: function () {
        this.getWishlist();
        $('#content_preloader').fadeOut(1000, function () {
          $('#content_index_commerce').animate({'opacity': 1}, 500);
        });

      },
      filters: {
        numberFormat: function (value) {
          return parseFloat(value).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        }
      },
      methods: {
        /*agrega el producto al carro de compras*/
        addCart: function (item) {
          vue_carting.addItemCart(item.id, item.name, item.price);
          this.deleteWishlist(item.id);
        },
        /* products wishlist */
        getWishlist: function () {
          this.preloader = true;
          if (this.user) {
            let token = "Bearer " + "{!! Auth::user() ? Auth::user()->createToken('Laravel Password Grant Client')->accessToken : "0" !!}";
            axios({
              method: 'get',
              responseType: 'json',
              url: "{{url('/')}}" + "/api/wishlistable/v1/wishlist",
              params: {
                filter: {
                  user: this.user
                }
              },
              headers: {
                'Authorization': token
              }
            }).then(response => {
              this.wishlists = response.data.data;
              this.preloader = false;
            });
          }//this.user
        },

        deleteWishlist(productId) {
          if (this.user) {
            let token = "Bearer " + "{!! Auth::user() ? Auth::user()->createToken('Laravel Password Grant Client')->accessToken : "0" !!}";
            axios({
              method: 'delete',
              responseType: 'json',
              url: "{{url('/')}}" + "/api/wishlistable/v1/wishlist" + '/' + productId,
              params: {},
              headers: {
                'Authorization': token
              }
            }).then(response => {
              window.livewire.emit("initWishlistQuantity")
              this.getWishlist();
            });
          }//this.user
        },

        /*alertas*/
        alerta: function (menssage, type) {
          toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 400,
            "hideDuration": 400,
            "timeOut": 4000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          };
          toastr[type](menssage);
        },
      }
    });
  </script>
@stop
