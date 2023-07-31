<div>
    <div class="container mx-auto px-4 text-center">

        <div class="my-10">
            <h4 class="heading-4">Convert WORD to PDF</h4>
            <p>Make DOC and DOCX files easy to read by converting them to PDF.</p>
        </div>


        <div class="my-4">
            <form method="POST" action="{{ route('wtp.conv') }}" enctype="multipart/form-data">
                @csrf
                <div class="btn-pri mx-auto w-[40rem]">
                    <input name="file" type="file" class="" id="wordfile" onchange="checkFile()">
                    Select Word Files
                </div>


                <div class="hidden btn-pri pt-10 mt-10 w-72 mx-auto rounded-lg" id="btn">
                    <button type="submit" class="">Convert to PDF</button>
                </div>
            </form>

            @if (session('dlink'))
                <div class="mt-10"><a href="{{ session('dlink') }}"
                        class="bg-blue-600 mx-auto text-white px-8 py-4">Download</a></div>
            @endif

        </div>

    </div>

    <script>

        var fileUpload = document.getElementById('wordfile');
        var hasFile = document.getElementById('wordfile').files.length;
        var btn = document.getElementById('btn');

        function checkFile(){

            if(fileUpload.files.length >0){
                    btn.style.display = "block";
            }



        }
    </script>

</div>
