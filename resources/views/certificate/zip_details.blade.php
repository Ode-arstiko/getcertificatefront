<div class="p-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Certificates {{ $zip['zip_name'] ?? '' }}</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 422px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Certificate Name</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($certificates as $cer)
                        <tr>
                            <td>
                                <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                            </td>

                            <td>
                                <h6 class="fw-semibold mb-0">
                                    {{ strlen($cer['certificate_name']) > 60
                                        ? substr($cer['certificate_name'], 0, 60) . '...'
                                        : $cer['certificate_name'] }}
                                </h6>
                            </td>

                            <td>
                                <p class="mb-0 fw-normal">
                                    {{ substr($cer['created_at'], 0, 10) }}
                                </p>
                            </td>

                            <td>
                                <a href="{{ route('certificates.download', $cer['id']) }}"
                                    class="btn btn-primary mb-0 shadow">
                                    <i class="ti ti-download me-2"></i>Download PDF
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Certificate kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
