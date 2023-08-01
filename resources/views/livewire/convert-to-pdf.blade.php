<div>
    <div class="container mx-auto px-4 text-center">

        <div class="my-10">
            <h4 class="heading-4">Convert WORD to PDF</h4>
            <p>Make DOC and DOCX files easy to read by converting them to PDF.</p>
        </div>


        <div class="my-4">
            <form method="POST" action="{{ route('wtp.conv') }}" enctype="multipart/form-data">
                @csrf
                <div class="cursor-pointer mb-10">
                    <span class="btn-pri mx-auto" id="uploadBtn">
                        <input name="file" type="file" class="hidden" id="fileInput" >
                    <label for="fileInput">Select Word Files</label>
                    </span>
                </div>

                <div class="hidden" id="imgPrev">
                    <img class="w-[127px] h-[180px] mx-auto" src="{{ asset('imgs/docx.svg') }}">
                    <span id="getFileName" class="text-black mt-2"></span>
                    


                </div>

                <div class="hidden btn-pri" id="btn">

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

        var uploadBtn = document.getElementById('uploadBtn');
        var tarFileName= document.getElementById('getFileName');
        var imgPrev = document.getElementById('imgPrev');
        // var fileUpload = document.getElementById('wordfile');
        // var hasFile = document.getElementById('wordfile').files.length;
        var btn = document.getElementById('btn');

        // function checkFile(){

        //     if(fileUpload.files.length >0){
        //             btn.style.display = "block";
        //     }

        // }

    //     function showThumbnail(file) {
    //     const reader = new FileReader();
    //     reader.onload = function(e) {
    //         const thumbnailElement = document.getElementById("thumbnail");
    //         thumbnailElement.src = e.target.result;
    //     };
    //     // console.log(reader);
    //     reader.readAsDataURL(file);
    // }

    // Event listener to trigger the thumbnail display when a file is selected
    const fileInput = document.getElementById("fileInput");
    fileInput.addEventListener("change", function(event) {
        const selectedFile = event.target.files[0];



        if (selectedFile) {
            uploadBtn.style.display="none";
            btn.style.display = "block";
            imgPrev.style.display = "block";
            console.log(tarFileName);
            tarFileName.textContent = selectedFile.name;
        }
    });

    </script>

</div>
