
<div>
<style type="text/css">
    /* tabs css start */
    /*
 CSS for the main interaction
*/
.tabset > input[type="radio"] {
  position: absolute;
  left: -200vw;
}

.tabset .tab-panel {
  display: none;
}

.tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
.tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
.tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
.tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
.tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
.tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
  display: block;
}

/*
 Styling
*/
body {
  font: 16px/1.5em "Overpass", "Open Sans", Helvetica, sans-serif;
  color: #333;
  font-weight: 300;
}

.tabset > label {
  position: relative;
  display: inline-block;
  padding: 15px 15px 25px;
  border: 1px solid transparent;
  border-bottom: 0;
  cursor: pointer;
  font-weight: 600;
}

.tabset > label::after {
  content: "";
  position: absolute;
  left: 15px;
  bottom: 10px;
  width: 22px;
  height: 4px;
  background: #8d8d8d;
}

input:focus-visible + label {
  outline: 2px solid #53B746;
  border-radius: 3px;
}

.tabset > label:hover,
.tabset > input:focus + label,
.tabset > input:checked + label {
  color: #53B746;
}

.tabset > label:hover::after,
.tabset > input:focus + label::after,
.tabset > input:checked + label::after {
  background: #53B746;
}

.tabset > input:checked + label {
  border-color: #ccc;
  border-bottom: 1px solid #fff;
  margin-bottom: -1px;
}

.tab-panel {
  padding: 30px 0;
  border-top: 1px solid #ccc;
}

/*
 Demo purposes only
*/
/* *, */
/* *:before,
*:after {
  box-sizing: border-box;
}

body {
  padding: 30px;
}

.tabset {
  max-width: 65em;
} */
    /* tabs css end  */
@media (max-width:575px) { 
    #quotation-details table .itemdescription {width: 150px; padding: 10px; height: 40px;}
    #quotation-details table input {width: 75px; padding: 10px; height: 40px;}
}
.contractor-sec .list-view .project-detail-item img {max-width: 20px;}
</style>  



@php 
$data =  \App\Models\ReportSection::select('content')->where('id',$section->id)
->where('report_id',$section->report_id)
->first();

$content = json_decode($data->content, true);

@endphp


<div class="tabset">
    <!-- Tab 1 -->
    <input type="radio" name="tabset" id="tab1" aria-controls="quotation-details" checked>
    <label for="tab1">Quotation Details</label>
    <!-- Tab 2 -->
    {{-- <input type="radio" name="tabset" id="tab2" aria-controls="new-quote1">
    <label for="tab2">New Quote 1</label>
    <!-- Tab 3 -->
    <input type="radio" name="tabset" id="tab3" aria-controls="new-quote2">
    <label for="tab3">New Quote 2</label> --}}
    
    <div class="tab-panels">
        <section id="quotation-details" class="tab-panel">
            <div class="row">
                <input type="hidden" name="sectionTypeId" id="sectionTypeId" value="{{ $section->id }}">
                <input type="hidden" name="reportId" id="reportId" value="{{ $section->report_id }}">
                    <div  class="d-flex flex-column flex-md-row tierTabSelectorContainer">
                        {{-- <!----> <ul  class="d-flex flex-column flex-md-row align-stretch pl-1 tieredPricingList list-group-horizontal test">
                        <li  class="list-group-item d-block">
                            <div  class="d-flex align-center pa-3  tierTabSelector tierTabSelector-selected"><span  class="fas fa-bars mr-2 listHandle"></span> <span  class="flex-grow-1 pl-2" style="word-break: break-all;">Quote Details</span> <!----></div>
                        </li></ul> 
                        <div  class="list-group-item"><div  class="pa-3 tierTabSelector d-flex align-center tierTabSelector-new">
                        <span  title="Add another quote" class="mr-2"><i  id="addQuotation" class="fas fa-plus open-close-tab"></i></span></div></div></div> --}}
            
             <div class="col-12">
                     <div class="mb-3">
                        <label for="quote_details_title" class="form-label">Title</label>
                        <input type="text" placeholder="Add Title"
                               value="{{ $content['quote_details_title'] ?? '' }}"
                               id="quote_details_title" class="form-control mb-2">
                    </div>
            
                    <div class="table-responsive">
                        <table id="itemTable" class="table" data-content="{{json_encode($content)}}">
                            <thead class="table-light">     
                            <tr>
                                <th width="40%">Description</th>
                                <th width="12%">Qty</th>
                                <th width="12%">Unit Price</th>
                                <th width="12%">Total</th>
                                <th width="12%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($content['items']) && count($content['items']) > 0)
                                @foreach ($content['items'] as $item)
                                    <tr>
                                        <td>
                                            <textarea class="itemdescription" name="itemdescription" placeholder="Item Details">{{ $item['description'] }}</textarea>
                                        </td>
                                        <td>
                                            <input class="itemqty" type="text" name="itemqty" value="{{ $item['qty'] }}">
                                        </td>
                                        <td>
                                            <input class="itemprice" type="text" name="itemprice" value="{{ $item['price'] }}">
                                        </td>
                                        <td>
                                            <input class="itemtotal" type="text" value="{{ $item['price'] }}" readonly name="itemtotal">
                                        </td>
                                        <td align="center">
                                            <span class="removeBtn">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <textarea class="itemdescription" name="itemdescription" placeholder="Item Details"></textarea>
                                    </td>
                                    <td>
                                        <input class="itemqty" type="text" name="itemqty" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </td>
                                    <td>
                                        <input class="itemprice" type="text" name="itemprice"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </td>
                                    <td>
                                        <input class="itemtotal" type="text" name="itemtotal">
                                    </td>
                                    <td align="center">
                                        <span class="removeBtn">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </span>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="additem-btn-wrap">
                        <div id="error-message" class="error-message" style="display: none;color:red"></div>
                        <a id="addItemBtn" class="additem-btn btn-outline-secondary">+ Add item</a>
                    </div>
                    <div class="field-wrap mt-4">
                        <div class="form-label">
                            <label for="address">Message to customer</label>
                        </div>
                        <div class="form-element">
                            <textarea id="message" type="text" name="message" placeholder="Note to customer">{{ $content['message'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
                        <div class="subtotal-title">Quote Subtotal:</div>
                        <div readonly class="quote-subtotal-detail" id="quote_subtotal"> </div>
                    </div>
                    <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
                        <div class="subtotal-title">Total:</div>
                        <div class="subtotal-detail" id="total"></div>
                    </div>
                </div>
                <div class="mb-3 pt-2">
                    <button id="saveQuoteDetails" class="btn-primary" type="button">Save</button>
                </div>
            </div>
            </div>
        </section>
      <section id="new-quote1" class="tab-panel">
        <div class="col-12">
            <div class="mb-3">
               <label for="new_quote_title1" class="form-label">Title</label>
               <input type="text" placeholder="Add Title"
                      value="{{ $content['new_quote_title1'] ?? '' }}"
                      id="new_quote_title1" class="form-control mb-2">
           </div>

           <div class="table-responsive">
            <table id="itemTableone" class="table" data-content="{{json_encode($content)}}">
                <thead class="table-light">     
                <tr>
                    <th width="40%">Description</th>
                    <th width="12%">Qty</th>
                    <th width="12%">Unit Price</th>
                    <th width="12%">Total</th>
                    <th width="12%"></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($content['itemsone']) && count($content['itemsone']) > 0)
                    @foreach ($content['itemsone'] as $item)
                        <tr>
                            <td>
                                <textarea class="itemdescriptionone" name="itemdescriptionone" placeholder="Item Details">{{ $item['description'] }}</textarea>
                            </td>
                            <td>
                                <input class="itemqtyone" type="text" name="itemqtyone" value="{{ $item['qty'] }}">
                            </td>
                            <td>
                                <input class="itempriceone" type="text" name="itempriceone" value="{{ $item['price'] }}">
                            </td>
                            <td>
                                <input class="itemtotalone" type="text" value="{{ $item['price'] }}" readonly name="itemtotalone">
                            </td>
                            <td align="center">
                                <span class="removeBtnone">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <textarea class="itemdescriptionone" name="itemdescriptionone" placeholder="Item Details"></textarea>
                        </td>
                        <td>
                            <input class="itemqtyone" type="text" name="itemqtyone" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </td>
                        <td>
                            <input class="itempriceone" type="text" name="itempriceone"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </td>
                        <td>
                            <input class="itemtotalone" type="text" name="itemtotalone">
                        </td>
                        <td align="center">
                            <span class="removeBtnone">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="additem-btn-wrap">
                    <div id="error-messageone" class="error-messageone" style="display: none;color:red"></div>
                    <a id="addItemBtnone" class="additem-btn btn-outline-secondary">+ Add item</a>
                </div>
                <div class="field-wrap">
                    <div class="form-label">
                        <label for="addressone">Message to customer</label>
                    </div>
                    <div class="form-element">
                        <textarea id="messageone" type="text" name="messageone" placeholder="Note to customer">{{ $content['message'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
                    <div class="subtotal-title">Quote Subtotal:</div> 
                    <div readonly class="quote-subtotal-detailone" id="quote_subtotalone"> 0.00</div>
                </div>
                <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
                    <div class="subtotal-title">Total:</div>
                    <div class="subtotal-detailone" id="totalone">0.00</div>
                </div>
            </div>
            <div class="mb-3 pt-2">
                <button id="saveQuoteDetailsone" class="btn-primary" type="button">Save</button>
            </div>
        </div>


        {{-- </div> --}}
    
        </section>
      <section id="new-quote2" class="tab-panel">
        <div class="col-12">
            <div class="mb-3">
               <label for="new_quote_title2" class="form-label">Title</label>
               <input type="text" placeholder="Add Title"
                      value="{{ $content['new_quote_title2'] ?? '' }}"
                      id="new_quote_title2" class="form-control mb-2">
           </div>

           <div class="table-responsive">
            <table id="itemTabletwo" class="table" data-content="{{json_encode($content)}}">
                <thead class="table-light">     
                <tr>
                    <th width="40%">Description</th>
                    <th width="12%">Qty</th>
                    <th width="12%">Unit Price</th>
                    <th width="12%">Total</th>
                    <th width="12%"></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($content['itemstwo']) && count($content['itemstwo']) > 0)
                    @foreach ($content['itemstwo'] as $item)
                        <tr>
                            <td>
                                <textarea class="itemdescriptiontwo" name="itemdescriptiontwo" placeholder="Item Details">{{ $item['description'] }}</textarea>
                            </td>
                            <td>
                                <input class="itemqtytwo" type="text" name="itemqtytwo" value="{{ $item['qty'] }}">
                            </td>
                            <td>
                                <input class="itempricetwo" type="text" name="itempricetwo" value="{{ $item['price'] }}">
                            </td>
                            <td>
                                <input class="itemtotaltwo" type="text" value="{{ $item['price'] }}" readonly name="itemtotaltwo">
                            </td>
                            <td align="center">
                                <span class="removeBtntwo">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <textarea class="itemdescriptiontwo" name="itemdescriptiontwo" placeholder="Item Details"></textarea>
                        </td>
                        <td>
                            <input class="itemqtytwo" type="text" name="itemqtytwo" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </td>
                        <td>
                            <input class="itempricetwo" type="text" name="itempricetwo"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </td>
                        <td>
                            <input class="itemtotaltwo" type="text" name="itemtotaltwo">
                        </td>
                        <td align="center">
                            <span class="removeBtntwo">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="additem-btn-wrap">
                    <div id="error-messagetwo" class="error-messagetwo" style="display: none;color:red"></div>
                    <a id="addItemBtntwo" class="additem-btn btn-outline-secondary">+ Add item</a>
                </div>
                <div class="field-wrap">
                    <div class="form-label">
                        <label for="addresstwo">Message to customer</label>
                    </div>
                    <div class="form-element">
                        <textarea id="messagetwo" type="text" name="messagetwo" placeholder="Note to customer">{{ $content['messagetwo'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
                    <div class="subtotal-title">Quote Subtotal:</div> 
                    <div readonly class="quote-subtotal-detailtwo" id="quote_subtotaltwo"> </div>
                </div>
                <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
                    <div class="subtotal-title">Total:</div>
                    <div class="subtotal-detailtwo" id="totaltwo"></div>
                </div>
            </div>
            <div class="mb-3 pt-2">
                <button id="saveQuoteDetailstwo" class="btn-primary" type="button">Save</button>
            </div>
        </div>
    </section>
    </div>
  </div>
</div>

{{-- <div class="row">
    <input type="hidden" name="sectionTypeId" id="sectionTypeId" value="{{ $section->id }}">
    <input type="hidden" name="reportId" id="reportId" value="{{ $section->report_id }}">
        <div  class="d-flex flex-column flex-md-row tierTabSelectorContainer"><!----> <ul  class="d-flex flex-column flex-md-row align-stretch pl-1 tieredPricingList list-group-horizontal test">
            <li  class="list-group-item d-block">
                <div  class="d-flex align-center pa-3  tierTabSelector tierTabSelector-selected"><span  class="fas fa-bars mr-2 listHandle"></span> <span  class="flex-grow-1 pl-2" style="word-break: break-all;">Quote Details</span> <!----></div>
            </li></ul> 
            <div  class="list-group-item"><div  class="pa-3 tierTabSelector d-flex align-center tierTabSelector-new">
            <span  title="Add another quote" class="mr-2"><i  id="addQuotation" class="fas fa-plus open-close-tab"></i></span></div></div></div>


          
    <div class="col-12">
         <div class="mb-3">
            <label for="quote_details_title" class="form-label">Title</label>
            <input type="text" placeholder="Add Title"
                   value="{{ $content['quote_details_title'] ?? '' }}"
                   id="quote_details_title" class="form-control mb-2">
        </div>

        <div class="table-responsive">
            <table id="itemTable" class="table" data-content="{{json_encode($content)}}">
                <thead class="table-light">     
                <tr>
                    <th width="40%">Description</th>
                    <th width="12%">Qty</th>
                    <th width="12%">Unit Price</th>
                    <th width="12%">Total</th>
                    <th width="12%"></th>
                </tr>
                </thead>
                <tbody>
                @if (isset($content['items']) && count($content['items']) > 0)
                    @foreach ($content['items'] as $item)
                        <tr>
                            <td>
                                <textarea class="itemdescription" name="itemdescription" placeholder="Item Details">{{ $item['description'] }}</textarea>
                            </td>
                            <td>
                                <input class="itemqty" type="text" name="itemqty" value="{{ $item['qty'] }}">
                            </td>
                            <td>
                                <input class="itemprice" type="text" name="itemprice" value="{{ $item['price'] }}">
                            </td>
                            <td>
                                <input class="itemtotal" type="text" value="{{ $item['price'] }}" readonly name="itemtotal">
                            </td>
                            <td align="center">
                                <span class="removeBtn">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <textarea class="itemdescription" name="itemdescription" placeholder="Item Details"></textarea>
                        </td>
                        <td>
                            <input class="itemqty" type="text" name="itemqty" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </td>
                        <td>
                            <input class="itemprice" type="text" name="itemprice"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </td>
                        <td>
                            <input class="itemtotal" type="text" name="itemtotal">
                        </td>
                        <td align="center">
                            <span class="removeBtn">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="additem-btn-wrap">
            <div id="error-message" class="error-message" style="display: none;color:red"></div>
            <a id="addItemBtn" class="additem-btn btn-outline-secondary">+ Add item</a>
        </div>
        <div class="field-wrap">
            <div class="form-label">
                <label for="address">Message to customer</label>
            </div>
            <div class="form-element">
                <textarea id="message" type="text" name="message" placeholder="Note to customer">{{ $content['message'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
            <div class="subtotal-title">Quote Subtotal:</div>
            <div readonly class="quote-subtotal-detail" id="quote_subtotal"> </div>
        </div>
        <div class="subtotal-title-wrap d-flex align-items-center justify-content-end">
            <div class="subtotal-title">Total:</div>
            <div class="subtotal-detail" id="total"></div>
        </div>
    </div>
    <div class="mb-3 pt-2">
        <button id="saveQuoteDetails" class="btn-primary" type="button">Save</button>
    </div>
</div>
</div> --}}





<script type="text/javascript">
    $(document).ready(function() {

        $(this).find(".itemtotal").each(function() {
            if ($(this).val() !== "0.00") {
                $(this).removeClass("invalid");
            }
        });
       //script quotation one
        // function updateTotal() {
        //     var subtotal = 0;
        //     $("#itemTable tbody tr").each(function() {
        //         var qty = parseFloat($(this).find(".itemqty").val()) || 0;
        //         var price = parseFloat($(this).find(".itemprice").val()) || 0;
        //         // var total = qty * price;
        //         var total = (qty && price) ? qty * price : 0;

        //         subtotal += total;
        //         $(this).find(".itemtotal").val(total.toFixed(2));
        //     });
        //     $(".subtotal-detail").text("$" + subtotal.toFixed(2));
        //     $(".quote-subtotal-detail").text("$" + subtotal.toFixed(2));
        // }


        function updateTotal() {
            var subtotal = 0;
            $("#itemTable tbody tr").each(function() {
                var qty = parseFloat($(this).find(".itemqty").val()) || 0;
                var price = parseFloat($(this).find(".itemprice").val()) || 0;
                var total = qty * price;

                subtotal += total;
                $(this).find(".itemtotal").val(total.toFixed(2));

                // Remove invalid class if total is valid
                if (total > 0) {
                    $(this).find(".itemtotal").removeClass("invalid");
                }
            });
            $(".subtotal-detail").text("$" + subtotal.toFixed(2));
            $(".quote-subtotal-detail").text("$" + subtotal.toFixed(2));
        }

        function saveItems() {
            var items = [];
            $("#itemTable tbody tr").each(function() {
                var qty = $(this).find(".itemqty").val();
                var price = $(this).find(".itemprice").val();
                var description = $(this).find(".itemdescription").val();
                items.push({
                    qty: qty,
                    price: price,
                    description: description
                });
            });
            localStorage.setItem('items', JSON.stringify(items));
        }

        function validateFields() {
            var isEmpty = false;
            $("#itemTable tbody").find('input[type="text"], textarea').each(function() {
                if ($(this).val().trim() === '') {
                    $(this).addClass("invalid");
                    isEmpty = true;
                } else {
                    $(this).removeClass("invalid");
                }
            });
            return isEmpty;
        }

        function loadItems() {
            var table = $("#itemTable");
            var content = table.data("content");
            if (content && content.items) {
                var rows = '';
                content.items.forEach(function(item) {
                    rows += '<tr>' +
                        '<td><textarea class="itemdescription" name="itemdescription" placeholder="Item Details">' + item.description + '</textarea></td>' +
                        '<td><input type="text" class="itemqty" value="' + item.qty + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
                        '<td><input type="text" class="itemprice" value="' + item.price + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
                        '<td><input type="text" class="itemtotal" name="itemtotal" readonly></td>' +
                        '<td align="center"><span class="removeBtn"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
                        '</tr>';
                });
                $("#itemTable tbody").html(rows);
                updateTotal();
            }
        }

        $("#itemTable").on('input', '.itemqty, .itemprice, .itemtotal, .itemdescription', function() {
            $(this).removeClass("invalid");  
            updateTotal();
            saveItems();
        });

        $("#itemTable").on('click', '.removeBtn', function() {
            $(this).closest('tr').remove();
            validateFields(); 
            updateTotal();
            saveItems();
        });

        $("#addItemBtn").click(function() {
            if (validateFields()) {
                return false; 
            }
            var newRow = '<tr>' +
                '<td><textarea class="itemdescription" name="itemdescription" placeholder="Item Details"></textarea></td>' +
                '<td><input type="text" class="itemqty" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
                '<td><input type="text" class="itemprice" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
                '<td><input type="text" class="itemtotal" name="itemtotal" readonly></td>' +
                '<td align="center"><span class="removeBtn"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
                '</tr>';
            $("#itemTable tbody").append(newRow);
        });

        $("#saveQuoteDetails").click(function() {
            // var reportId = $('#reportId').val();
            // var sectionTypeId = $('#sectionTypeId').val();
            // var content = {
            //     quote_details_title: $("#quote_details_title").val(),
            //     items: []
            // };

            // $("#itemTable tbody tr").each(function() {
            //     var qty = $(this).find(".itemqty").val();
            //     var price = $(this).find(".itemprice").val();
            //     var description = $(this).find(".itemdescription").val();
            //     content.items.push({
            //         qty: qty,
            //         price: price,
            //         description: description
            //     });
            // });



        //     $.ajax({
        //         url: '/store/quotationinfo' ,
        //         type: 'POST',
        //         data: {
        //             report_id: reportId,
        //             sectionTypeId: sectionTypeId,
        //             content: JSON.stringify(content),
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(response) {
        //             if (response.success) {
        //                 $('#toast-message .toast-body').text('Data saved successfully!');
        //                 var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
        //                     autohide: true,
        //                     delay: 3000
        //                 });
        //                 toast.show();
        //             }
        //         },
        //         error: function() {
        //             alert('Error saving quote details');
        //         }
        //     });

        // new code 
            var reportId = $('#reportId').val();
            var sectionTypeId = $('#sectionTypeId').val();
           
            var contenttwo = {
                new_quote_title2: $("#new_quote_title2").val(),
                message:$('#message').text(),
                itemstwo: []
            };

            var contentone = {
                new_quote_title1: $("#new_quote_title1").val(),
                message:$('#message').text(),
                itemsone: []
            };

            var content = {
                quote_details_title: $("#quote_details_title").val(),
                message : $('#message').val(),
                items: []
            };

            $("#itemTableone tbody tr").each(function() {
                var qty = $(this).find(".itemqtyone").val();
                var price = $(this).find(".itempriceone").val();
                var description = $(this).find(".itemdescriptionone").val();
                contentone.itemsone.push({
                    qty: qty,
                    price: price,
                    description: description
                });
            });


            $("#itemTabletwo tbody tr").each(function() {
                var qty = $(this).find(".itemqtytwo").val();
                var price = $(this).find(".itempricetwo").val();
                var description = $(this).find(".itemdescriptiontwo").val();
                contenttwo.itemstwo.push({
                    qty: qty,
                    price: price,
                    description: description
                });
            });


            $("#itemTable tbody tr").each(function() {
                var qty = $(this).find(".itemqty").val();
                var price = $(this).find(".itemprice").val();
                var description = $(this).find(".itemdescription").val();
                content.items.push({
                    qty: qty,
                    price: price,
                    description: description
                });
            });
            saveQuoteDetails(reportId, sectionTypeId, content, contentone,contenttwo); // new code
                // end new code 
                });
                loadItems();

                // end quotation one script 


                // Quotatuon Two scripts

    function updateTotalone() {
        var subtotal = 0;
        $("#itemTableone tbody tr").each(function() {
            var qty = parseFloat($(this).find(".itemqtyone").val()) || 0;
            // console.log("qty"  + qty);
            var price = parseFloat($(this).find(".itempriceone").val()) || 0;
            var totalone = qty * price;
            // console.log("total" + totalone);
            subtotal += totalone;
            // console.log("subtotal" + subtotal);
            $(this).find(".itemtotalone").val(totalone.toFixed(2));
        });
        $(".subtotal-detailone").text("$" + subtotal.toFixed(2));
        $(".quote-subtotal-detailone").text("$" + subtotal.toFixed(2));
    }

    function saveItemsone() {
        var itemsone = [];
        $("#itemTableone tbody tr").each(function() {
            var qty = $(this).find(".itemqtyone").val();
            var price = $(this).find(".itempriceone").val();
            var description = $(this).find(".itemdescriptionone").val();
            itemsone.push({
                qty: qty,
                price: price,
                description: description
            });
        });
        localStorage.setItem('itemsone', JSON.stringify(itemsone));
    }

    function validateFieldsone() {
        var isEmpty = false;
        $("#itemTableone tbody").find('input[type="text"], textarea').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass("invalid");
                isEmpty = true;
            } else {
                $(this).removeClass("invalid");
            }
        });
        return isEmpty;
    }

    function loadItemsone() {
        var table = $("#itemTableone");
        var contentone = table.data("content");
        if (contentone && contentone.itemsone) {
            var rows = '';
            contentone.itemsone.forEach(function(itemone) {
                rows += '<tr>' +
                    '<td><textarea class="itemdescriptionone" name="itemdescriptionone" placeholder="Item Details">' + itemone.description + '</textarea></td>' +
                    '<td><input type="text" class="itemqtyone" value="' + itemone.qty + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
                    '<td><input type="text" class="itempriceone" value="' + itemone.price + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
                    '<td><input type="text" class="itemtotalone" name="itemtotal" readonly></td>' +
                    '<td align="center"><span class="removeBtnone"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
                    '</tr>';
            });
            $("#itemTableone tbody").html(rows);
            updateTotalone();
        }
    }



    $("#itemTableone").on('input', '.itemqtyone, .itempriceone, .itemdescriptionone', function() {
            $(this).removeClass("invalid");  
            updateTotalone();
            saveItemsone();
        });

        $("#itemTableone").on('click', '.removeBtnone', function() {
            $(this).closest('tr').remove();
            validateFieldsone(); 
            updateTotalone();
            saveItemsone();
        });

        $("#addItemBtnone").click(function() {
            if (validateFieldsone()) {
                return false; 
            }
            var newRow = '<tr>' +
                '<td><textarea class="itemdescriptionone" name="itemdescriptionone" placeholder="Item Details"></textarea></td>' +
                '<td><input type="text" class="itemqtyone" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
                '<td><input type="text" class="itempriceone" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
                '<td><input type="text" class="itemtotalone" name="itemtotalone" readonly></td>' +
                '<td align="center"><span class="removeBtnone"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
                '</tr>';
            $("#itemTableone tbody").append(newRow);
        });
        $("#saveQuoteDetailsone").click(function() {
            // var reportId = $('#reportId').val();
            // var sectionTypeId = $('#sectionTypeId').val();
            // var contentone = {
            //     quote_details_title: $("#new_quote_title1").val(),
            //     items: []
            // };

            // $("#itemTableone tbody tr").each(function() {
            //     var qty = $(this).find(".itemqtyone").val();
            //     var price = $(this).find(".itempriceone").val();
            //     var description = $(this).find(".itemdescriptionone").val();
            //     contentone.items.push({
            //         qty: qty,
            //         price: price,
            //         description: description
            //     });
            // });

            // $.ajax({
            //     url: '/store/quotationinfo' ,
            //     type: 'POST',
            //     data: {
            //         report_id: reportId,
            //         sectionTypeId: sectionTypeId,
            //         contentone: JSON.stringify(contentone),
            //         _token: '{{ csrf_token() }}'
            //     },
            //     success: function(response) {
            //         if (response.success) {
            //             $('#toast-message .toast-body').text('Data saved successfully!');
            //             var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
            //                 autohide: true,
            //                 delay: 3000
            //             });
            //             toast.show();
            //         }
            //     },
            //     error: function() {
            //         alert('Error saving quote details');
            //     }
            // });


                 // new code 
    var reportId = $('#reportId').val();
    var sectionTypeId = $('#sectionTypeId').val();
    
    var contentone = {
        new_quote_title1: $("#new_quote_title1").val(),
        itemsone: []
    };


    var contenttwo = {
        new_quote_title2: $("#new_quote_title2").val(),
        itemstwo: []
    };

    var content = {
        quote_details_title: $("#quote_details_title").val(),
        items: []
    };

    $("#itemTabletwo tbody tr").each(function() {
        var qty = $(this).find(".itemqtytwo").val();
        var price = $(this).find(".itempricetwo").val();
        var description = $(this).find(".itemdescriptiontwo").val();
        contenttwo.itemstwo.push({
            qty: qty,
            price: price,
            description: description
        });
    });


    $("#itemTableone tbody tr").each(function() {
        var qty = $(this).find(".itemqtyone").val();
        var price = $(this).find(".itempriceone").val();
        var description = $(this).find(".itemdescriptionone").val();
        contentone.itemsone.push({
            qty: qty,
            price: price,
            description: description
        });
    });

    $("#itemTable tbody tr").each(function() {
        var qty = $(this).find(".itemqty").val();
        var price = $(this).find(".itemprice").val();
        var description = $(this).find(".itemdescription").val();
        content.items.push({
            qty: qty,
            price: price,
            description: description
        });
    });
    saveQuoteDetails(reportId, sectionTypeId, content, contentone,contenttwo); // new code


        // end new code 
        // });
        });
        loadItemsone();
    // end Quotation one script


    // quotation script two

        function updateTotaltwo() {
            var subtotal = 0;
            $("#itemTabletwo tbody tr").each(function() {
                var qty = parseFloat($(this).find(".itemqtytwo").val()) || 0;
                // console.log("qty"  + qty);
                var price = parseFloat($(this).find(".itempricetwo").val()) || 0;
                var totalone = qty * price;
                // console.log("total" + totalone);
                subtotal += totalone;
                // console.log("subtotal" + subtotal);
                $(this).find(".itemtotaltwo").val(totalone.toFixed(2));
            });
            $(".subtotal-detailtwo").text("$" + subtotal.toFixed(2));
            $(".quote-subtotal-detailtwo").text("$" + subtotal.toFixed(2));
        }
    
        function saveItemstwo() {
            var itemstwo = [];
            $("#itemTabletwo tbody tr").each(function() {
                var qty = $(this).find(".itemqtytwo").val();
                var price = $(this).find(".itempricetwo").val();
                var description = $(this).find(".itemdescriptiontwo").val();
                itemstwo.push({
                    qty: qty,
                    price: price,
                    description: description
                });
            });
            localStorage.setItem('itemstwo', JSON.stringify(itemstwo));
        }
    
        function validateFieldstwo() {
            var isEmpty = false;
            $("#itemTabletwo tbody").find('input[type="text"], textarea').each(function() {
                if ($(this).val().trim() === '') {
                    $(this).addClass("invalid");
                    isEmpty = true;
                } else {
                    $(this).removeClass("invalid");
                }
            });
            return isEmpty;
        }
    
        function loadItemstwo() {
            var table = $("#itemTabletwo");
            var contenttwo = table.data("content");
            if (contenttwo && contenttwo.itemstwo) {
                var rows = '';
                contenttwo.itemstwo.forEach(function(itemstwo) {
                    rows += '<tr>' +
                        '<td><textarea class="itemdescriptiontwo" name="itemdescriptiontwo" placeholder="Item Details">' + itemstwo.description + '</textarea></td>' +
                        '<td><input type="text" class="itemqtytwo" value="' + itemstwo.qty + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
                        '<td><input type="text" class="itempricetwo" value="' + itemstwo.price + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
                        '<td><input type="text" class="itemtotaltwo" name="itemtotal" readonly></td>' +
                        '<td align="center"><span class="removeBtntwo"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
                        '</tr>';
                });
                $("#itemTabletwo tbody").html(rows);
                updateTotaltwo();
            }
        }
    
    
    
        $("#itemTabletwo").on('input', '.itemqtytwo, .itempricetwo, .itemdescriptiontwo', function() {
                $(this).removeClass("invalid");  
                updateTotaltwo();
                saveItemstwo();
            });
    
            $("#itemTabletwo").on('click', '.removeBtntwo', function() {
                $(this).closest('tr').remove();
                validateFieldstwo(); 
                updateTotaltwo();
                saveItemstwo();
            });
    
            $("#addItemBtntwo").click(function() {
                if (validateFieldstwo()) {
                    return false; 
                }
                var newRow = '<tr>' +
                    '<td><textarea class="itemdescriptiontwo" name="itemdescriptiontwo" placeholder="Item Details"></textarea></td>' +
                    '<td><input type="text" class="itemqtytwo" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
                    '<td><input type="text" class="itempricetwo" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
                    '<td><input type="text" class="itemtotaltwo" name="itemtotaltwo" readonly></td>' +
                    '<td align="center"><span class="removeBtntwo"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
                    '</tr>';
                $("#itemTabletwo tbody").append(newRow);
            });
            $("#saveQuoteDetailstwo").click(function() {
                    // new code 
                    var reportId = $('#reportId').val();
                    var sectionTypeId = $('#sectionTypeId').val();
                    
                    var contentone = {
                        new_quote_title1: $("#new_quote_title1").val(),
                        itemsone: []
                    };

                    var contenttwo = {
                        new_quote_title2: $("#new_quote_title2").val(),
                        itemstwo: []
                    };
                
                    var content = {
                        quote_details_title: $("#quote_details_title").val(),
                        items: []
                    };
                
                    $("#itemTableone tbody tr").each(function() {
                        var qty = $(this).find(".itemqtyone").val();
                        var price = $(this).find(".itempriceone").val();
                        var description = $(this).find(".itemdescriptionone").val();
                        contentone.itemsone.push({
                            qty: qty,
                            price: price,
                            description: description
                        });
                    });

                    $("#itemTabletwo tbody tr").each(function() {
                        var qty = $(this).find(".itemqtytwo").val();
                        var price = $(this).find(".itempricetwo").val();
                        var description = $(this).find(".itemdescriptiontwo").val();
                        contenttwo.itemstwo.push({
                            qty: qty,
                            price: price,
                            description: description
                        });
                    });
                
                    $("#itemTable tbody tr").each(function() {
                        var qty = $(this).find(".itemqty").val();
                        var price = $(this).find(".itemprice").val();
                        var description = $(this).find(".itemdescription").val();
                        content.items.push({
                            qty: qty,
                            price: price,
                            description: description
                        });
                    });
        saveQuoteDetails(reportId, sectionTypeId, content, contentone,contenttwo); // new code
    
    
            // end new code 
            // });
            });
            loadItemstwo();
         
    // end quotation script two




      // quotation one store script 
        // function saveQuoteDetails(reportId, sectionTypeId, content, contentone) {
        //     $.ajax({
        //         url: '/store/quotationinfo',
        //         type: 'POST',
        //         data: {
        //             report_id: reportId,
        //             sectionTypeId: sectionTypeId,
        //             contentone: JSON.stringify(contentone),
        //             content: JSON.stringify(content),
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(response) {
        //             if (response.success) {
        //                 $('#toast-message .toast-body').text('Data saved successfully!');
        //                 var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
        //                     autohide: true,
        //                     delay: 3000
        //                 });
        //                 toast.show();
        //             }
        //         },
        //         error: function() {
        //             alert('Error saving quote details');
        //         }
        //     });
        // }
        function saveQuoteDetails(reportId, sectionTypeId, content, contentone,contenttwo) {
            $.ajax({
                url: '/store/quotationinfo',
                type: 'POST',
                data: {
                    report_id: reportId,
                    sectionTypeId: sectionTypeId,
                    contenttwo:JSON.stringify(contenttwo),
                    contentone: JSON.stringify(contentone),
                    content: JSON.stringify(content),
                    // content: content+contentone,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#toast-message .toast-body').text('Data saved successfully!');
                        var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
                            autohide: true,
                            delay: 3000
                        });
                        toast.show();
                    }
                },
                error: function() {
                    alert('Error saving quote details');
                }
            });
        }
        // quotation one store script 

    });
</script>

<script type="text/javascript">

// $(document).ready(function() {
    // function updateTotalone() {
    //     var subtotal = 0;
    //     $("#itemTableone tbody tr").each(function() {
    //         var qty = parseFloat($(this).find(".itemqtyone").val()) || 0;
    //         // console.log("qty"  + qty);
    //         var price = parseFloat($(this).find(".itempriceone").val()) || 0;
    //         var totalone = qty * price;
    //         // console.log("total" + totalone);
    //         subtotal += totalone;
    //         // console.log("subtotal" + subtotal);
    //         $(this).find(".itemtotalone").val(totalone.toFixed(2));
    //     });
    //     $(".subtotal-detailone").text("$" + subtotal.toFixed(2));
    //     $(".quote-subtotal-detailone").text("$" + subtotal.toFixed(2));
    // }

    // function saveItemsone() {
    //     var itemsone = [];
    //     $("#itemTableone tbody tr").each(function() {
    //         var qty = $(this).find(".itemqtyone").val();
    //         var price = $(this).find(".itempriceone").val();
    //         var description = $(this).find(".itemdescriptionone").val();
    //         itemsone.push({
    //             qty: qty,
    //             price: price,
    //             description: description
    //         });
    //     });
    //     localStorage.setItem('itemsone', JSON.stringify(itemsone));
    // }

    // function validateFields() {
    //     var isEmpty = false;
    //     $("#itemTableone tbody").find('input[type="text"], textarea').each(function() {
    //         if ($(this).val().trim() === '') {
    //             $(this).addClass("invalid");
    //             isEmpty = true;
    //         } else {
    //             $(this).removeClass("invalid");
    //         }
    //     });
    //     return isEmpty;
    // }

    // function loadItemsone() {
    //     var table = $("#itemTableone");
    //     var contentone = table.data("content");
    //     if (contentone && contentone.itemsone) {
    //         var rows = '';
    //         contentone.itemsone.forEach(function(itemone) {
    //             rows += '<tr>' +
    //                 '<td><textarea class="itemdescriptionone" name="itemdescriptionone" placeholder="Item Details">' + itemone.description + '</textarea></td>' +
    //                 '<td><input type="text" class="itemqtyone" value="' + itemone.qty + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
    //                 '<td><input type="text" class="itempriceone" value="' + itemone.price + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
    //                 '<td><input type="text" class="itemtotalone" name="itemtotal" readonly></td>' +
    //                 '<td align="center"><span class="removeBtnone"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
    //                 '</tr>';
    //         });
    //         $("#itemTableone tbody").html(rows);
    //         updateTotalone();
    //     }
    // }



    // $("#itemTableone").on('input', '.itemqtyone, .itempriceone, .itemdescriptionone', function() {
    //         $(this).removeClass("invalid");  
    //         updateTotalone();
    //         saveItemsone();
    //     });

    //     $("#itemTableone").on('click', '.removeBtnone', function() {
    //         $(this).closest('tr').remove();
    //         validateFields(); 
    //         updateTotalone();
    //         saveItemsone();
    //     });

    //     $("#addItemBtnone").click(function() {
    //         if (validateFields()) {
    //             return false; 
    //         }
    //         var newRow = '<tr>' +
    //             '<td><textarea class="itemdescriptionone" name="itemdescriptionone" placeholder="Item Details"></textarea></td>' +
    //             '<td><input type="text" class="itemqtyone" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
    //             '<td><input type="text" class="itempriceone" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
    //             '<td><input type="text" class="itemtotalone" name="itemtotalone" readonly></td>' +
    //             '<td align="center"><span class="removeBtnone"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
    //             '</tr>';
    //         $("#itemTableone tbody").append(newRow);
    //     });
    //     $("#saveQuoteDetailsone").click(function() {
    //         // var reportId = $('#reportId').val();
    //         // var sectionTypeId = $('#sectionTypeId').val();
    //         // var contentone = {
    //         //     quote_details_title: $("#new_quote_title1").val(),
    //         //     items: []
    //         // };

    //         // $("#itemTableone tbody tr").each(function() {
    //         //     var qty = $(this).find(".itemqtyone").val();
    //         //     var price = $(this).find(".itempriceone").val();
    //         //     var description = $(this).find(".itemdescriptionone").val();
    //         //     contentone.items.push({
    //         //         qty: qty,
    //         //         price: price,
    //         //         description: description
    //         //     });
    //         // });

    //         // $.ajax({
    //         //     url: '/store/quotationinfo' ,
    //         //     type: 'POST',
    //         //     data: {
    //         //         report_id: reportId,
    //         //         sectionTypeId: sectionTypeId,
    //         //         contentone: JSON.stringify(contentone),
    //         //         _token: '{{ csrf_token() }}'
    //         //     },
    //         //     success: function(response) {
    //         //         if (response.success) {
    //         //             $('#toast-message .toast-body').text('Data saved successfully!');
    //         //             var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
    //         //                 autohide: true,
    //         //                 delay: 3000
    //         //             });
    //         //             toast.show();
    //         //         }
    //         //     },
    //         //     error: function() {
    //         //         alert('Error saving quote details');
    //         //     }
    //         // });


    //              // new code 
    // var reportId = $('#reportId').val();
    // var sectionTypeId = $('#sectionTypeId').val();
    
    // var contentone = {
    //     new_quote_title1: $("#new_quote_title1").val(),
    //     itemsone: []
    // };

    // var content = {
    //     quote_details_title: $("#quote_details_title").val(),
    //     items: []
    // };

    // $("#itemTableone tbody tr").each(function() {
    //     var qty = $(this).find(".itemqtyone").val();
    //     var price = $(this).find(".itempriceone").val();
    //     var description = $(this).find(".itemdescriptionone").val();
    //     contentone.itemsone.push({
    //         qty: qty,
    //         price: price,
    //         description: description
    //     });
    // });

    // $("#itemTable tbody tr").each(function() {
    //     var qty = $(this).find(".itemqty").val();
    //     var price = $(this).find(".itemprice").val();
    //     var description = $(this).find(".itemdescription").val();
    //     content.items.push({
    //         qty: qty,
    //         price: price,
    //         description: description
    //     });
    // });
    // saveQuoteDetails(reportId, sectionTypeId, content, contentone); // new code


    //     // end new code 
    //     // });
    //     });
    //     loadItemsone();
        

//     function saveQuoteDetails(reportId, sectionTypeId, content, contentone) {
//         $.ajax({
//             url: '/store/quotationinfo',
//             type: 'POST',
//             data: {
//                 report_id: reportId,
//                 sectionTypeId: sectionTypeId,
//                 contentone: JSON.stringify(contentone),
//                 content: JSON.stringify(content),
//                 // content: content+contentone,
//                 _token: '{{ csrf_token() }}'
//             },
//             success: function(response) {
//                 if (response.success) {
//                     $('#toast-message .toast-body').text('Data saved successfully!');
//                     var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
//                         autohide: true,
//                         delay: 3000
//                     });
//                     toast.show();
//                 }
//             },
//             error: function() {
//                 alert('Error saving quote details');
//             }
//         });
//     }
// });

// $(document).ready(function() {
//     function updateTotalone() {
//         var subtotal = 0;
//         $("#itemTableone tbody tr").each(function() {
//             var qty = parseFloat($(this).find(".itemqtyone").val()) || 0;
//             var price = parseFloat($(this).find(".itempriceone").val()) || 0;
//             var total = qty * price;
//             subtotal += total;
//             $(this).find(".itemtotalone").val(total.toFixed(2));
//         });
//         $(".subtotal-detailone").text("$" + subtotal.toFixed(2));
//         $(".quote-subtotal-detailone").text("$" + subtotal.toFixed(2));
//     }

//     function saveItems() {
//         var itemsone = [];
//         $("#itemTableone tbody tr").each(function() {
//             var qty = $(this).find(".itemqtyone").val();
//             var price = $(this).find(".itempriceone").val();
//             var description = $(this).find(".itemdescriptionone").val();
//             itemsone.push({
//                 qty: qty,
//                 price: price,
//                 description: description
//             });
//         });
//         localStorage.setItem('items', JSON.stringify(itemsone));
//     }

//     function validateFields() {
//         var isEmpty = false;
//         $("#itemTableone tbody").find('input[type="text"], textarea').each(function() {
//             if ($(this).val().trim() === '') {
//                 $(this).addClass("invalid");
//                 isEmpty = true;
//             } else {
//                 $(this).removeClass("invalid");
//             }
//         });
//         return isEmpty;
//     }

//     function loadItems() {
//         var table = $("#itemTableone");
//         var contentone = table.data("content");
//         if (contentone && contentone.itemsone) {
//             var rows = '';
//             contentone.itemsone.forEach(function(itemone) {
//                 rows += '<tr>' +
//                     '<td><textarea class="itemdescriptionone" name="itemdescriptionone" placeholder="Item Details">' + itemone.description + '</textarea></td>' +
//                     '<td><input type="text" class="itemqty" value="' + itemone.qty + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
//                     '<td><input type="text" class="itemprice" value="' + itemone.price + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
//                     '<td><input type="text" class="itemtotal" name="itemtotal" readonly></td>' +
//                     '<td align="center"><span class="removebtn"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
//                     '</tr>';
//             });
//             $("#itemTableone tbody").html(rows);
//             updateTotalone();
//         }
//     }



//     $("#itemTableone").on('input', '.itemqtyone, .itempriceone, .itemdescriptionone', function() {
//             $(this).removeClass("invalid");  
//             updateTotalone();
//             saveItems();
//         });

//         $("#itemTableone").on('click', '.removeBtnone', function() {
//             $(this).closest('tr').remove();
//             validateFields(); 
//             updateTotalone();
//             saveItems();
//         });

//         $("#addItemBtnone").click(function() {
//             if (validateFields()) {
//                 return false; 
//             }
//             var newRow = '<tr>' +
//                 '<td><textarea class="itemdescriptionone" name="itemdescriptionone" placeholder="Item Details"></textarea></td>' +
//                 '<td><input type="text" class="itemqtyone" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
//                 '<td><input type="text" class="itempriceone" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
//                 '<td><input type="text" class="itemtotalone" name="itemtotalone" readonly></td>' +
//                 '<td align="center"><span class="removeBtnone"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
//                 '</tr>';
//             $("#itemTableone tbody").append(newRow);
//         });
//         $("#saveQuoteDetailsone").click(function() {
//             // var reportId = $('#reportId').val();
//             // var sectionTypeId = $('#sectionTypeId').val();
//             // var contentone = {
//             //     quote_details_title: $("#new_quote_title1").val(),
//             //     items: []
//             // };

//             // $("#itemTableone tbody tr").each(function() {
//             //     var qty = $(this).find(".itemqtyone").val();
//             //     var price = $(this).find(".itempriceone").val();
//             //     var description = $(this).find(".itemdescriptionone").val();
//             //     contentone.items.push({
//             //         qty: qty,
//             //         price: price,
//             //         description: description
//             //     });
//             // });

//             // $.ajax({
//             //     url: '/store/quotationinfo' ,
//             //     type: 'POST',
//             //     data: {
//             //         report_id: reportId,
//             //         sectionTypeId: sectionTypeId,
//             //         contentone: JSON.stringify(contentone),
//             //         _token: '{{ csrf_token() }}'
//             //     },
//             //     success: function(response) {
//             //         if (response.success) {
//             //             $('#toast-message .toast-body').text('Data saved successfully!');
//             //             var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
//             //                 autohide: true,
//             //                 delay: 3000
//             //             });
//             //             toast.show();
//             //         }
//             //     },
//             //     error: function() {
//             //         alert('Error saving quote details');
//             //     }
//             // });


//                  // new code 
//     var reportId = $('#reportId').val();
//     var sectionTypeId = $('#sectionTypeId').val();
    
//     var contentone = {
//         new_quote_title1: $("#new_quote_title1").val(),
//         itemsone: []
//     };

//     var content = {
//         quote_details_title: $("#quote_details_title").val(),
//         items: []
//     };

//     $("#itemTableone tbody tr").each(function() {
//         var qty = $(this).find(".itemqtyone").val();
//         var price = $(this).find(".itempriceone").val();
//         var description = $(this).find(".itemdescriptionone").val();
//         contentone.itemsone.push({
//             qty: qty,
//             price: price,
//             description: description
//         });
//     });

//     $("#itemTable tbody tr").each(function() {
//         var qty = $(this).find(".itemqty").val();
//         var price = $(this).find(".itemprice").val();
//         var description = $(this).find(".itemdescription").val();
//         content.items.push({
//             qty: qty,
//             price: price,
//             description: description
//         });
//     });
//     saveQuoteDetails(reportId, sectionTypeId, content, contentone); // new code


//         // end new code 
//         // });
//         });
//         loadItems();
        

//  function saveQuoteDetails(reportId, sectionTypeId, content, contentone) {
//     $.ajax({
//         url: '/store/quotationinfo',
//         type: 'POST',
//         data: {
//             report_id: reportId,
//             sectionTypeId: sectionTypeId,
//             contentone: JSON.stringify(contentone),
//             content: JSON.stringify(content),
//             _token: '{{ csrf_token() }}'
//         },
//         success: function(response) {
//             if (response.success) {
//                 $('#toast-message .toast-body').text('Data saved successfully!');
//                 var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
//                     autohide: true,
//                     delay: 3000
//                 });
//                 toast.show();
//             }
//         },
//         error: function() {
//             alert('Error saving quote details');
//         }
//     });
// }


// });
    </script>


{{-- <script type="text/javascript">
    $(document).ready(function() {
        function updateTotal() {
            var subtotal = 0;
            $("#itemTable tbody tr").each(function() {
                var qty = parseFloat($(this).find(".itemqty").val()) || 0;
                var price = parseFloat($(this).find(".itemprice").val()) || 0;
                var total = qty * price;
                subtotal += total;
                $(this).find(".itemtotal").val(total.toFixed(2));
            });
            $(".subtotal-detail").text("$" + subtotal.toFixed(2));
            $(".quote-subtotal-detail").text("$" + subtotal.toFixed(2));
        }

        function saveItems() {
            var items = [];
            $("#itemTable tbody tr").each(function() {
                var qty = $(this).find(".itemqty").val();
                var price = $(this).find(".itemprice").val();
                var description = $(this).find(".itemdescription").val();
                items.push({
                    qty: qty,
                    price: price,
                    description: description
                });
            });
            localStorage.setItem('items', JSON.stringify(items));
        }

        function loadItems() {
            var table = $("#itemTable");
            var content = table.data("content");
            if (content && content.items) {
                var rows = '';
                content.items.forEach(function(item) {
                    rows += '<tr>' +
                        '<td><textarea class="itemdescription" name="itemdescription" placeholder="Item Details">' + item.description + '</textarea></td>' +
                        '<td><input type="text" class="itemqty" value="' + item.qty + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
                        '<td><input type="text" class="itemprice" value="' + item.price + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
                        '<td><input type="text" class="itemtotal" name="itemtotal" readonly></td>' +
                        '<td align="center"><span class="removeBtn"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
                        '</tr>';
                });
                $("#itemTable tbody").html(rows);
                updateTotal();
            }
        }

        $("#itemTable").on('input', '.itemqty, .itemprice', function() {
            updateTotal();
            saveItems();
        });

        $("#itemTable").on('click', '.removeBtn', function() {
            $(this).closest('tr').remove();
            updateTotal();
            saveItems();
        });

        $("#addItemBtn").click(function() {
            var isEmpty = false;
            $("#itemTable tbody").find('input[type="text"], textarea').each(function() {
                if ($(this).val().trim() === '') {
                    $(this).addClass("invalid");
                    isEmpty = true;
                }
            });
            if (isEmpty) {
                return "";
            }
            var newRow = '<tr>' +
                '<td><textarea class="itemdescription" name="itemdescription" placeholder="Item Details"></textarea></td>' +
                '<td><input type="text" class="itemqty" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
                '<td><input type="text" class="itemprice" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
                '<td><input type="text" class="itemtotal" name="itemtotal" readonly></td>' +
                '<td align="center"><span class="removeBtn"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
                '</tr>';
            $("#itemTable tbody").append(newRow);
        });

        $("#saveQuoteDetails").click(function() {
            var reportId = $('#reportId').val();
            var sectionTypeId = $('#sectionTypeId').val();
            var content = {
                quote_details_title: $("#quote_details_title").val(),
                items: JSON.parse(localStorage.getItem('items') || '[]')
            };
            $.ajax({
                url: '/store/quotationinfo',
                type: 'POST',
                data: {
                    // _token: $('meta[name="csrf-token"]').attr('content'),
                    report_id: reportId,
                    sectionTypeId: sectionTypeId,
                    content: JSON.stringify(content),
                    _token: '{{ csrf_token() }}'
                    // content: content

                },
                success: function(response) {
                    alert('Quote details saved successfully');
                },
                error: function() {
                    alert('Error saving quote details');
                }
            });
        });

        // Load items when the page is ready
        loadItems();
    });
</script> --}}

{{-- <script type="text/javascript">
    $(document).ready(function() {
        function updateTotal() {
            var subtotal = 0;
            $("#itemTable tbody tr").each(function() {
                var qty = parseFloat($(this).find(".itemqty").val()) || 0;
                var price = parseFloat($(this).find(".itemprice").val()) || 0;
                var total = qty * price;
                subtotal += total;
                $(this).find(".itemtotal").val(total.toFixed(2));
            });
            $(".subtotal-detail").text("$" + subtotal.toFixed(2));
            $(".quote-subtotal-detail").text("$" + subtotal.toFixed(2));
        }

        function saveItems() {
            var items = [];
            $("#itemTable tbody tr").each(function() {
                var qty = $(this).find(".itemqty").val();
                var price = $(this).find(".itemprice").val();
                var description = $(this).find(".itemdescription").val();
                items.push({
                    qty: qty,
                    price: price,
                    description: description
                });
            });
            localStorage.setItem('items', JSON.stringify(items));
        }

        function loadItems() {
            var items = JSON.parse(localStorage.getItem('items') || '[]');
            var rows = '';
            items.forEach(function(item) {
                rows += '<tr>' +
                    '<td><textarea class="itemdescription" name="itemdescription" placeholder="Item Details">' + item.description + '</textarea></td>' +
                    '<td><input type="text" class="itemqty" value="' + item.qty + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
                    '<td><input type="text" class="itemprice" value="' + item.price + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
                    '<td><input type="text" class="itemtotal" name="itemtotal" readonly></td>' +
                    '<td align="center"><span class="removeBtn"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
                    '</tr>';
            });
            $("#itemTable tbody").html(rows);
            updateTotal();
        }

        $("#itemTable").on('input', '.itemqty, .itemprice', function() {
            updateTotal();
            saveItems();
        });

        $("#itemTable").on('click', '.removeBtn', function() {
            $(this).closest('tr').remove();
            updateTotal();
            saveItems();
        });

        $("#addItemBtn").click(function() {
            var isEmpty = false;
            $("#itemTable tbody").find('input[type="text"], textarea').each(function() {
                if ($(this).val().trim() === '') {
                    $(this).addClass("invalid");
                    isEmpty = true;
                }
            });
            if (isEmpty) {
                return "";
            }
            var newRow = '<tr>' +
                '<td><textarea class="itemdescription" name="itemdescription" placeholder="Item Details"></textarea></td>' +
                '<td><input type="text" class="itemqty" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
                '<td><input type="text" class="itemprice" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
                '<td><input type="text" class="itemtotal" name="itemtotal" readonly></td>' +
                '<td align="center"><span class="removeBtn"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
                '</tr>';
            $("#itemTable tbody").append(newRow);
        });

        $("#saveQuoteDetails").click(function() {
            var reportId = $('#reportId').val();
            var sectionTypeId = $('#sectionTypeId').val();
            var content = {
                quote_details_title: $("#quote_details_title").val(),
                items: JSON.parse(localStorage.getItem('items') || '[]'),
                message: $("#message").val()
            };
            $.ajax({
                url: '/store/quotationinfo',
                method: 'POST',
                data: {
                    report_id: reportId,
                    sectionTypeId: sectionTypeId,
                    content: JSON.stringify(content),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#toast-message .toast-body').text('Data saved successfully!');
                        var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
                            autohide: true,
                            delay: 3000
                        });
                        toast.show();
                    }
                }
            });
        });

        loadItems();
    
    $('#addQuotation').on('click',function(event){
        $('.test').append(`<li  class="list-group-item d-block">
                <div  class="d-flex align-center pa-3 tierTabSelector tierTabSelector-selected"><span  class="fas fa-bars mr-2 listHandle"></span> <span  class="flex-grow-1 pl-2" style="word-break: break-all;">Quote Details</span> <!----></div>
            </li>`);
            // $('.test .newQuote').empty().append(`<li  class="list-group-item d-block">
            //     <div  class="d-flex align-center pa-3 tierTabSelector tierTabSelector-selected"><span  class="fas fa-bars mr-2 listHandle"></span> <span  class="flex-grow-1 pl-2" style="word-break: break-all;">Quote Details</span> <!----></div>
            // </li>`);
    });
    
    });


</script> --}}

{{-- thired section  quotation script --}}
<script type="text/javascript">

    // $(document).ready(function() {
        // function updateTotaltwo() {
        //     var subtotal = 0;
        //     $("#itemTabletwo tbody tr").each(function() {
        //         var qty = parseFloat($(this).find(".itemqtytwo").val()) || 0;
        //         // console.log("qty"  + qty);
        //         var price = parseFloat($(this).find(".itempricetwo").val()) || 0;
        //         var totalone = qty * price;
        //         // console.log("total" + totalone);
        //         subtotal += totalone;
        //         // console.log("subtotal" + subtotal);
        //         $(this).find(".itemtotaltwo").val(totalone.toFixed(2));
        //     });
        //     $(".subtotal-detailtwo").text("$" + subtotal.toFixed(2));
        //     $(".quote-subtotal-detailtwo").text("$" + subtotal.toFixed(2));
        // }
    
        // function saveItemstwo() {
        //     var itemstwo = [];
        //     $("#itemTabletwo tbody tr").each(function() {
        //         var qty = $(this).find(".itemqtytwo").val();
        //         var price = $(this).find(".itempricetwo").val();
        //         var description = $(this).find(".itemdescriptiontwo").val();
        //         itemstwo.push({
        //             qty: qty,
        //             price: price,
        //             description: description
        //         });
        //     });
        //     localStorage.setItem('itemstwo', JSON.stringify(itemstwo));
        // }
    
        // function validateFields() {
        //     var isEmpty = false;
        //     $("#itemTabletwo tbody").find('input[type="text"], textarea').each(function() {
        //         if ($(this).val().trim() === '') {
        //             $(this).addClass("invalid");
        //             isEmpty = true;
        //         } else {
        //             $(this).removeClass("invalid");
        //         }
        //     });
        //     return isEmpty;
        // }
    
        // function loadItemstwo() {
        //     var table = $("#itemTabletwo");
        //     var contenttwo = table.data("content");
        //     if (contenttwo && contenttwo.itemstwo) {
        //         var rows = '';
        //         contenttwo.itemstwo.forEach(function(itemstwo) {
        //             rows += '<tr>' +
        //                 '<td><textarea class="itemdescriptiontwo" name="itemdescriptiontwo" placeholder="Item Details">' + itemstwo.description + '</textarea></td>' +
        //                 '<td><input type="text" class="itemqtytwo" value="' + itemstwo.qty + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
        //                 '<td><input type="text" class="itempricetwo" value="' + itemstwo.price + '" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"></td>' +
        //                 '<td><input type="text" class="itemtotaltwo" name="itemtotal" readonly></td>' +
        //                 '<td align="center"><span class="removeBtntwo"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
        //                 '</tr>';
        //         });
        //         $("#itemTabletwo tbody").html(rows);
        //         updateTotaltwo();
        //     }
        // }
    
    
    
        // $("#itemTabletwo").on('input', '.itemqtytwo, .itempricetwo, .itemdescriptiontwo', function() {
        //         $(this).removeClass("invalid");  
        //         updateTotaltwo();
        //         saveItemstwo();
        //     });
    
        //     $("#itemTabletwo").on('click', '.removeBtntwo', function() {
        //         $(this).closest('tr').remove();
        //         validateFields(); 
        //         updateTotaltwo();
        //         saveItemstwo();
        //     });
    
        //     $("#addItemBtntwo").click(function() {
        //         if (validateFields()) {
        //             return false; 
        //         }
        //         var newRow = '<tr>' +
        //             '<td><textarea class="itemdescriptiontwo" name="itemdescriptiontwo" placeholder="Item Details"></textarea></td>' +
        //             '<td><input type="text" class="itemqtytwo" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
        //             '<td><input type="text" class="itempricetwo" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')"  value=""></td>' +
        //             '<td><input type="text" class="itemtotaltwo" name="itemtotaltwo" readonly></td>' +
        //             '<td align="center"><span class="removeBtntwo"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 5H4.16667H17.5" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8337 4.99984V16.6665C15.8337 17.1085 15.6581 17.5325 15.3455 17.845C15.0329 18.1576 14.609 18.3332 14.167 18.3332H5.83366C5.39163 18.3332 4.96771 18.1576 4.65515 17.845C4.34259 17.5325 4.16699 17.1085 4.16699 16.6665V4.99984M6.66699 4.99984V3.33317C6.66699 2.89114 6.84259 2.46722 7.15515 2.15466C7.46771 1.8421 7.89163 1.6665 8.33366 1.6665H11.667C12.109 1.6665 12.5329 1.8421 12.8455 2.15466C13.1581 2.46722 13.3337 2.89114 13.3337 3.33317V4.99984" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33301 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.667 9.1665V14.1665" stroke="#0A84FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></td>' +
        //             '</tr>';
        //         $("#itemTabletwo tbody").append(newRow);
        //     });
        //     $("#saveQuoteDetailstwo").click(function() {
        //             // new code 
        //             var reportId = $('#reportId').val();
        //             var sectionTypeId = $('#sectionTypeId').val();
                    
        //             var contentone = {
        //                 new_quote_title1: $("#new_quote_title1").val(),
        //                 itemsone: []
        //             };

        //             var contenttwo = {
        //                 new_quote_title2: $("#new_quote_title2").val(),
        //                 itemstwo: []
        //             };
                
        //             var content = {
        //                 quote_details_title: $("#quote_details_title").val(),
        //                 items: []
        //             };
                
        //             $("#itemTableone tbody tr").each(function() {
        //                 var qty = $(this).find(".itemqtyone").val();
        //                 var price = $(this).find(".itempriceone").val();
        //                 var description = $(this).find(".itemdescriptionone").val();
        //                 contentone.itemsone.push({
        //                     qty: qty,
        //                     price: price,
        //                     description: description
        //                 });
        //             });

        //             $("#itemTabletwo tbody tr").each(function() {
        //                 var qty = $(this).find(".itemqtytwo").val();
        //                 var price = $(this).find(".itempricetwo").val();
        //                 var description = $(this).find(".itemdescriptiontwo").val();
        //                 contenttwo.itemstwo.push({
        //                     qty: qty,
        //                     price: price,
        //                     description: description
        //                 });
        //             });
                
        //             $("#itemTable tbody tr").each(function() {
        //                 var qty = $(this).find(".itemqty").val();
        //                 var price = $(this).find(".itemprice").val();
        //                 var description = $(this).find(".itemdescription").val();
        //                 content.items.push({
        //                     qty: qty,
        //                     price: price,
        //                     description: description
        //                 });
        //             });
        // saveQuoteDetails(reportId, sectionTypeId, content, contentone,contenttwo); // new code
    
    
        //     // end new code 
        //     // });
        //     });
        //     loadItemstwo();
            
    
    //     function saveQuoteDetails(reportId, sectionTypeId, content, contentone,contenttwo) {
    //         $.ajax({
    //             url: '/store/quotationinfo',
    //             type: 'POST',
    //             data: {
    //                 report_id: reportId,
    //                 sectionTypeId: sectionTypeId,
    //                 contenttwo:JSON.stringify(contenttwo),
    //                 contentone: JSON.stringify(contentone),
    //                 content: JSON.stringify(content),
    //                 // content: content+contentone,
    //                 _token: '{{ csrf_token() }}'
    //             },
    //             success: function(response) {
    //                 if (response.success) {
    //                     $('#toast-message .toast-body').text('Data saved successfully!');
    //                     var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
    //                         autohide: true,
    //                         delay: 3000
    //                     });
    //                     toast.show();
    //                 }
    //             },
    //             error: function() {
    //                 alert('Error saving quote details');
    //             }
    //         });
    //     }
    // });
    </script>

