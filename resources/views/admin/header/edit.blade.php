@foreach ($karcis as $item)
    <div class="modal fade text-left" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel160">Update Header Karcis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ url('admin/header-edit/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Header 1</label>
                                    <input type="text" class="form-control" name="header1" id="header1"
                                        value="{{ $item->header1 }}" placeholder="Masukkan Header">
                                </div>
                                <div class="form-group">
                                    <label for="">Header 3</label>
                                    <input type="text" class="form-control" name="header3" id="header3"
                                        value="{{ $item->header3 }}" placeholder="Masukkan Header">
                                </div>
                                <div class="form-group">
                                    <label for="">Footer 1</label>
                                    <input type="text" class="form-control" name="footer1" id="footer1"
                                        value="{{ $item->footer1 }}" placeholder="Masukkan Footer">
                                </div>
                                <div class="form-group">
                                    <label for="">Footer 3</label>
                                    <input type="text" class="form-control" name="footer4" id="footer4"
                                        value="{{ $item->footer3 }}" placeholder="Masukkan Footer">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Header 2</label>
                                    <input type="text" class="form-control" name="header2" id="header2"
                                        value="{{ $item->header2 }}" placeholder="Masukkan Header">
                                </div>
                                <div class="form-group">
                                    <label for="">Header 4</label>
                                    <input type="text" class="form-control" name="header4" id="header4"
                                        value="{{ $item->header4 }}" placeholder="Masukkan Header">
                                </div>
                                <div class="form-group">
                                    <label for="">Footer 2</label>
                                    <input type="text" class="form-control" name="footer2" id="footer2"
                                        value="{{ $item->footer2 }}" placeholder="Masukkan Footer">
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" class="form-control" name="footer 4" id="footer4"
                                        value="{{ $item->footer4 }}" placeholder="Masukkan Footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
