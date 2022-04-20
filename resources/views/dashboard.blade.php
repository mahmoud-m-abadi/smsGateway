<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SMS Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                 <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                     <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                         <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                             <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-500 dark:text-gray-600">
                             <tr>
                                 <th scope="col" class="px-6 py-3">
                                     Phone number
                                 </th>
                                 <th scope="col" class="px-6 py-3">
                                     Provider
                                 </th>
                                 <th scope="col" class="px-6 py-3">
                                     Result
                                 </th>
                                 <th scope="col" class="px-6 py-3">
                                     Status
                                 </th>
                                 <th scope="col" class="px-6 py-3">
                                     <span class="sr-only">Sent at</span>
                                 </th>
                             </tr>
                             </thead>
                             <tbody>
                                @foreach($items as $item)
                                 <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                         {{$item->to}}
                                     </th>
                                     <td class="px-6 py-4">
                                         {{$item->provider}}
                                     </td>
                                     <td class="px-6 py-4">
                                         <ul>
                                             @foreach($item->result as $resultKey => $result)
                                                 <li>{{$resultKey}} : {{$result}}</li>
                                             @endforeach
                                         </ul>
                                     </td>
                                     <td class="px-6 py-4">
                                         {{$item->status_code}}
                                     </td>
                                     <td class="px-6 py-4">
                                         {{$item->created_at->format('Y-m-d H:i:s')}}
                                     </td>
                                 </tr>
                                @endforeach
                             </tbody>
                             <tfooter class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-500 dark:text-gray-600">
                                 <tr>
                                     <td class="text-right px-6 py-4">
                                         {{$items->links()}}
                                     </td>
                                 </tr>
                             </tfooter>
                         </table>
                     </div>
                 </div>
            </div>
        </div>
    </div>
</x-app-layout>
