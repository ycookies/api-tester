<style>
    .mailbox-attachment-icon {
        max-height: none;
    }
    .mailbox-attachment-info {
        background: #fff;
    }
    .mailbox-attachments .img-thumbnail {
        border: 1px solid #fff;
        border-radius: 0;
        background-color: #fff;
    }
    .mailbox-attachment-icon.has-img>img {
        max-width: 100%!important;
        /*height: 180px!important;*/
    }
    .mailbox-attachment-info .item {
        margin-bottom: 6px;
    }
    .mailbox-attachments li {
        box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
        border: 0;
        background: #fff;
    }

    body.dark-mode .table {
        background-color: #2c2c43;
    }
    body.dark-mode .mailbox-attachments .img-thumbnail {
        border-color: #223;
        background-color: #223;
    }
    body.dark-mode .mailbox-attachment-info {
        background: #223;
    }
    body.dark-mode .mailbox-attachments li {
        border-color: #223;
        background-color: #223;
    }
    body.dark-mode .mailbox-attachment-name {
        color: #a8a9bb
    }
</style>


<div class="dcat-box custom-data-table dt-bootstrap4">

    @include('ycookies.api-tester::subview.table-toolbar')

    {!! $grid->renderFilter() !!}

    {!! $grid->renderHeader() !!}

    <div class="table-responsive table-wrapper mt-1">
        <ul class="mailbox-attachments clearfix {{ $grid->formatTableClass() }} p-0"  id="{{ $tableId }}">
            @foreach($grid->rows() as $row)
                <li>
                    <span class="mailbox-attachment-icon has-img">
                        <img  src="{!! $row->column('logo') !!}" style="max-width:200px;max-height:200px;cursor:pointer" class="img img-thumbnail">
                    </span>
                    <div class="mailbox-attachment-info">
                        {{--<div class="d-flex justify-content-between item">
                            <span class="mailbox-attachment-name"></span> {!! $row->column('id') !!}
                        </div>--}}


                        <a href="{{url('admin/ycookies/api-tester')}}?proj_id={{ $row->column('id') }}" class="d-flex item">
                            <span class="mailbox-attachment-name"></span> {!! $row->column('name') !!}
                        </a>

                        <span class="d-flex justify-content-between" style="margin-top: 5px">
                            {!! $row->column(Dcat\Admin\Grid\Column::SELECT_COLUMN_NAME) !!}
                            <div>{!! $row->column(Dcat\Admin\Grid\Column::ACTION_COLUMN_NAME) !!}</div>
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    {!! $grid->renderFooter() !!}

    {{--@include('admin::grid.table-pagination')--}}

</div>
