<!-- list -->
<style>
#indexProfile {
    --border-r: .5rem;
    --color1: #f5f5f5;
    background-color: var(--color1);
    & #profileContent {
        margin-bottom: 0 !important;
        & .title {
          display: none;
        }
    }
}

#contentWishlist {
    padding: 3rem 0;

	& .list-link-return {
      font-size: 16px;
      display: inline-block;
      color: var(--dark);
	}

	& .list-title {
      text-align: center;
      font-weight: bold;
      font-size: 30px;
      color: var(--primary);
      margin-bottom: 2rem;
	}

	& .list-card {
	    border-radius: var(--border-r);
	}

	& .list-card-header {
      padding: 15px 25px;
      border-radius: var(--border-r) var(--border-r) 0 0;
      background-color: #ffffff;
      border-bottom: 2px solid var(--color1);
      color: var(--primary);
      font-weight: bold;
      font-size: 21px;
	}

	& .list-card-body {
        padding: 30px 25px;
        background-color: #ffffff;
        border-radius: var(--border-r);

        &.bottom {
             border-radius: 0 0 var(--border-r) var(--border-r);
        }

	    & .list-card-steps {
            display: grid;
            margin: 0 25px;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            & .card-step {
                border: 0;
                border-radius: 20px;
                padding: 30px;
                text-align: center;
                display: block;
                & img {
                    width: 300px !important;
                    height: auto;
                    object-fit: contain;
                    max-height: 200px;
            }
	    }

	    @media (max-width: 991.98px) {
		    margin: 0;
		    grid-template-columns: 1fr;
	        & .card-step {
		        padding: 15px;
	            & img {
		            width: 100% !important;
	            }
	        }
	    }
	}

	& .list-card-num-title {
        display: grid;
	    font-size: 18px;
	    line-height: 20px;
	    gap: 10px;
	    grid-template-columns: auto 1fr;
	    margin-bottom: 20px;
	    min-height: 60px;
	    & .icon-num {
	        height: 42px;
		    width: 42px;
		    font-size: 22px;
		    font-weight: bold;
		    color: #fff;
		    background-color: var(--primary);
		    border-radius: 50%;
		    display: flex;
		    align-items: center;
		    justify-content: center;
	    }
	}

	& .list-card-input-group {
	    & .input-group-prepend > .btn{
		    border-top-left-radius: 5rem;
		    border-bottom-left-radius: 5rem;
	    }
	    & .input-group-append > .btn {
		    border-top-right-radius: 5rem;
		    border-bottom-right-radius: 5rem;
	    }
	    & .form-control {
		    border: 1px solid var(--dark);
	    }
	}

	& .list-card-img {
        display: flex;
	    align-items: center;
	    & img {
	        height: 122px;
		    width: 122px !important;
		    object-fit: cover;
		    border: 1px solid var(--dark);
		    border-radius: 20px;
		    padding: 2px;
	    }

	    @media (max-width: 767.98px) {
		    display: block;
	        & img {
		        height: 90px;
		        width: 90px !important;
	        }
	    }
	}

	& .list-card-price {
        font-size: 20px;
	}

	& .list-card-item {
        border-radius: var(--border-r);
	    border: 1px solid #d2d2d2;
        padding: 20px 25px;

        &.item-light {
            border-color: var(--primary);
            background-color: #f0f0f0;
            box-shadow: 1px 1px 10px #f0f0f0;
        }

	    &:not(:last-child) {
		    margin-bottom: 30px;
	    }

	    & .item-card-title {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        & .item-card-subtitle {
            font-size: 16px;
            line-height: 18px;
        }

        & .item-card-delete {
            color: var(--primary);
            font-size: 16px;
            display: block
        }
	}

    & .list-card-footer {
        text-align: right;
        margin-top: 30px;
    }
}

</style>

@include("wishlistable::frontend.partials.style-modal")