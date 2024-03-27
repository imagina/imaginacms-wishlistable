
<style>
/* tooltip */
.tooltip {
& .arrow:before {
      border-top-color: var(--secondary);
  }
& .tooltip-inner {
      background-color: var(--secondary);
  }
}


/* swal2-modal */
.swal2-icommerce-modal-list > .swal2-modal {
    padding: 0;
    & .swal2-header {
        padding: 0;
        background-color: #f5f5f5;
        border-radius: 8px;
        & .swal2-title {
          border-bottom: 1px solid #969696;
          padding: 15px 20px;
          text-align: left;
          background: #ebebeb;
          font-size: 22px;
          line-height: 22px;
          border-radius: 8px 8px 0 0;
          width: 100%;
          margin-bottom: 0;
        }
        & .swal2-close {
          width: 20px;
          height: 20px;
          font-size: 18px;
          border: 1px solid #828282;
          border-radius: 50%;
          color: #828282;
          top: 15px;
          right: 15px;
        }
    }
    & .swal2-content {
        padding-top: 1.6rem;
        & .swal2-input, & .swal2-select  {
            border: 1px solid #969696;
            border-radius: 5px;
            height: 2.5em;
            padding: 0 0.75em;
             width: 90%;
        }
        & img {
            width: 100px !important;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
    }
    & .swal2-actions {
        margin-bottom: 20px;
        & .swal2-confirm {
          background-color: var(--primary);
          font-size: 18px;
          line-height: 18px;
        }
        & .swal2-cancel {
          color: var(--primary);
          background-color: transparent;
          border: 1px solid var(--primary);
          font-size: 18px;
          line-height: 18px;
          &:hover {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #fff;
          }
        }
    }
}

/* bootstrap-modal */
.wishlist-modal-list {
    & .modal-content {
        background-color: #f5f5f5;
    }
    & .modal-header {
        background: #ebebeb;
        border-bottom: 1px solid #969696;
        & .close {
          font-size: 18px;
          border: 1px solid #828282;
          border-radius: 50%;
          padding: 0;
          margin: 0;
          width: 20px;
          height: 20px;
          color: #828282;
        }
        & .modal-title {
          font-size: 22px;
          line-height: 22px;
          border-radius: 8px 8px 0 0;
        }
    }
    & .modal-body {
        & .modal-subtitle {
              font-size: 1.4em;
              margin-top: 15px;
              margin-bottom: 20px;
        }
        & img {
          width: 100px !important;
          height: 100px;
          object-fit: cover;
          border-radius: 5px;
        }
        & .form-control {
          border: 1px solid #969696;
          border-radius: 5px;
          height: 2.5em;
          padding: 0 0.75em;
          width: 90%;
          font-size: 1.125em;
        }
    }

    & .modal-footer {
          border-top: 0;
          justify-content: center;

        & .btn {
          background-color: var(--primary);
          font-size: 18px;
          line-height: 18px;
          color: #fff;
          padding: 0.625em 1.1em;
          font-weight: 500;

            & + .btn {
              margin-left: 10px;
            }

            &.outline {
                 border: 1px solid var(--primary);
                 background-color: #ffffff;
                 color: var(--primary);
                &:hover {
                 background-color: var(--primary);
                 color: #fff;
                }
            }
        }
    }
}
</style>