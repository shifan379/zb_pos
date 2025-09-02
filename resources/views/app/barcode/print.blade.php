<!DOCTYPE html>
<html>

<head>
    <title>Print Barcode</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        @media print {
            @page {
                margin: 0;
                size: 105mm 25mm; /* exact label size */

            }

            body {
                margin: 0;
                padding: 0;
            }

            .label-container {
                width: 105mm;
                height: 25mm;
                overflow: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
                page-break-after: always;
            }

            .label-image {
                width: 105mm;
                height: 25mm;
                object-fit: contain;
            }
        }

        body {
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .label-container {
            width: 105mm;
            height: 25mm;
            margin: 0 auto;
        }

        .label-image {
            width: 105mm;
            height: 25mm;
            object-fit: contain;
        }
    </style>
</head>

<body>
    @foreach ($images as $img)
        <div class="label-container">
            <img class="label-image" src="{{ url($img) }}" alt="Label Image">
        </div>
    @endforeach

    <script>
        window.onload = function () {
            setTimeout(function () {
                window.print();
                setTimeout(function () {
                    fetch("{{ route('barcode.delete') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({})
                    }).then(() => {
                        window.location.href = "{{ route('barcode.index') }}";
                    }).catch(() => {
                        window.location.href = "{{ route('barcode.index') }}";
                    });
                }, 100);
            }, 50);
        };
    </script>

</body>

</html>
