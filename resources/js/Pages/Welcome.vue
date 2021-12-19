<template>
    <!-- <Head title="Welcome" /> -->
<div class="
            bg-gray-300 min-h-screen flex flex-col items-center justify-center">


    <div
        class="
            
            flex
            mt-15
            justify-center
            
            bg-gray-300
            gap-4
            sm:items-center sm:pt-0
        "
    >
    <div class="mt-2">
                <label class="block text-sm font-semibold text-gray-700 mx-auto"
                  >Select Brand</label
                >
              
        <select
            name="brands"
            id="brands"
            class="
                border-gray-300
                focus:border-indigo-300
                focus:ring
                focus:ring-indigo-200
                focus:ring-opacity-50
                rounded-md
                shadow-sm
            "
            v-model="cur_brandid"
            @change="curfilter.cur_brandid=cur_brandid"
            aria-placeholder="brand"
        >
            <!-- <option value="0" selected>--select brand --</option> -->
            <option
                :value="brand.id"
                v-for="(brand, ind) in brands"
                :key="ind"
                
            >
                {{ brand.name }}
            </option>
        </select>
    </div>
    <div class="mt-2">
                <label class="block text-sm font-semibold text-gray-700 mx-auto"
                  >Select Quantity</label
                >
             
        <input
            placeholder="qty"
            type="number"
            @change="curfilter.qty=curfilter.qty<1?1:curfilter.qty"
            name="qty"
            id="qty"
            v-model="curfilter.qty"
            class="
                border-gray-300
                focus:border-indigo-300
                focus:ring
                focus:ring-indigo-200
                focus:ring-opacity-50
                rounded-md
                shadow-sm
            "
        />
    </div>
    <div class="mt-2">
                <label class="block text-sm font-semibold text-gray-700 mx-auto"
                  >Select Operation</label
                >
             
        <select
            name="ops"
            id="ops"
            
            v-model="cur_op"
            @change="curfilter.op=cur_op"
            class="
                border-gray-300
                focus:border-indigo-300
                focus:ring
                focus:ring-indigo-200
                focus:ring-opacity-50
                rounded-md
                shadow-sm
            "
        >
            <!-- <option value="0" @click="curfilter.op = null">
                --select operation --
            </option> -->

            <option
                :value="op"
                v-for="(op, ind) in ops"
                :key="ind"
                
            >
                {{ op }}
            </option>
        </select>
    </div>
    
        <button
            class="
                bg-green-100
                text-green-700
                rounded-xl
                p-2
                hover:bg-green-700 hover:text-white
                duration-300
                cursor-pointer mt-6
            "
            @click="search"
            :disabled="!(cur_brandid&&cur_op&&curfilter.qty)"

            >Search</button
        >
    </div>
<div class="w-full p-10" v-if="stock.length">
      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="flex flex-col m-auto content-center">
        <div class="my-2 sm:-mx-6 lg:-mx-8">
          <div
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div class="shadow border-b border-gray-200 sm:rounded-lg overflow-hidden">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-600 text-white">
                  <tr>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        tracking-wider
                      "
                    >
                      Model
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        tracking-wider
                      "
                    >
                      Qty
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-xs
                        font-medium
                        tracking-wider
                      "
                    >
                      Action
                    </th>
                    
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr
                    v-for="(model, ind) in stock"
                    :key="ind"
                    class="hover:bg-gray-200"
                  >
                    <td class="px-6 py-4 ">
                        {{model.name}}
                    </td>
                    <td class="px-6 py-4 ">
                        {{model.stock_count}}
                    </td>
                    <td >
                        <span class="p-2 bg-indigo-100 text-indigo-800 hover:text-white hover:bg-indigo-600 cursor-pointer rounded-full duration-500">

                        View Items
                        </span>
                    </td>
                  </tr>

                  <!-- More items... -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <span v-else-if="cur_op" class="m-15">-- No Stock --</span>
    <span v-else class="m-15">-- Please select proper opeation --</span>
        
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import loadash from "lodash";

export default {
    components: {
        Link,
    },
    props: ["brands", "filter", "stock"],
    data() {
        return {
            curfilter: [],
            ops: [">", "<", ">=", "<="],
            cur_brandid:this.filter.cur_brandid,
            cur_op:this.filter.op,
        };
    },
    mounted() {
        this.curfilter = { ...this.filter };
        this.cur_op=this.ops.find(op=>op==this.curfilter.op);
        console.log(this.cur_op);

    },
    methods: {
        search() {
            let filter = loadash.pickBy(this.curfilter);
            this.$inertia.visit(this.route("stock", filter), {
                method: "get",
                preserveState: true,
            });
        },
    },
};
</script>
