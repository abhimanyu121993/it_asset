@extends('Backend.Layouts.panel')

@section('Style-Area')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<style>
</style>
@endsection

@section('Content-Area')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0">
            <h4>Report by Location</h4>
            <hr>
        </div>
        <div class="card-header pb-0 d-flex justify-content-between">
            <div class="btn btn-group">
                <button class="btn btn-primary" id="copy-button"><i class="far fa-copy"></i> Copy</button>
                <button class="btn btn-secondary" id="csvButton"><i class="fas fa-file-csv"></i> CSV</button>
                <a href="{{url('/locations')}}" class="btn btn-success"><i class="fas fa-file-pdf"></i> PDF</a>
                <a href="{{url('/getLocation')}}" class="btn btn-info"><i class="fas fa-print"></i> Print</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr class="text-center">
                                <th>SL</th>
                                <th>Asset Code</th>
                                <th>Asset Type</th>
                                <th>Asset</th>
                                <th>Price</th>
                                <th>Location</th>
                                <th>Sub Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($location as $locations)
                            <tr class="copy-content text-center">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$locations->product_number??'N/A'}}</td>
                                <td>{{$locations->asset_type->name??'N/A'}}</td>
                                <td>{{$locations->assetmain->name??'N/A'}}</td>
                                <td>{{$locations->price??'N/A'}}</td>
                                <td>{{$locations->location->name??'N/A'}}</td>
                                <td>{{$locations->sublocation->name??'N/A'}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Script-Area')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const copyButton = document.getElementById("copy-button");

        copyButton.addEventListener("click", function() {
            const copyContents = document.querySelectorAll(".copy-content");
            let copiedText = '';

            copyContents.forEach(content => {
                copiedText += content.textContent.trim() + '\n';
            });

            const textarea = document.createElement("textarea");
            textarea.value = copiedText;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);

            const originalButtonText = copyButton.textContent;
            copyButton.textContent = "Copied!";
            setTimeout(function() {
                copyButton.textContent = originalButtonText;
            }, 1500);
        });
    });
</script>

<script>
    document.getElementById('csvButton').addEventListener('click', function() {
        const table = document.getElementById('basic-1');
        const rows = table.querySelectorAll('tbody tr');
        const csvData = [];

        rows.forEach(function(row) {
            const rowData = [];
            row.querySelectorAll('td').forEach(function(cell) {
                rowData.push(cell.innerText);
            });
            csvData.push(rowData.join(','));
        });

        const csvContent = 'data:text/csv;charset=utf-8,' + csvData.join('\n');
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'report_by_location.csv');
        document.body.appendChild(link);
        link.click();
    });
</script>


@endsection
