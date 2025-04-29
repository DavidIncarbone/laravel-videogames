   <tr>
       <td>
           <div class="d-flex justify-content-center w-100" style="height:66px">
               {{ $checkbox }}
           </div>
       </td>
       <td>
           <div class="d-flex justify-content-center align-items-center" style="height:66px">
               <div>
                   {{ $show }}

                   <a class=" text-decoration-none text-dark" {{ $edit }}>
                       <i id="pencil" class="bi bi-pencil"></i>
                   </a>

                   {{ $delete }}
               </div>
           </div>

       </td>

       {{-- FIRST TD --}}

       <td class="w-25">
           {{ $firstTd }}
       </td>

       {{-- SECOND TD --}}


       {{ $secondTd }}


       {{-- CREATED AND UPDATED TD --}}

       <td class="not-break">
           <div class="d-flex justify-content-center align-items-center " style="height:50px">
               <div>{{ $created }}</div>
           </div>
       </td>
       <td class="not-break">
           <div class="d-flex justify-content-center align-items-center" style="height:50px">
               <div>{{ $updated }}</div>
           </div>
       </td>
   </tr>
