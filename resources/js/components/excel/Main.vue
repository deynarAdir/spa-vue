<template>
	<div class="container">
		<input
		  accept=".xlsx"
		  type="file"
		  @change="fileReader"
		/>
		<button class="btn btn-info" @click="exportExcel()">Exportar</button>
	</div>
</template>
<script>
	import XLSX from 'xlsx';
	export default{
		components: {
			XLSX
		},
		data(){
			return {
				dataToExport: [
			        {
			          name: 'Jorge',
			          occupation: 'Best Admin'
			        },
			        {
			          name: 'Héctor',
			          occupation: 'Worst Admin'
			        },
			        {
			          name: 'gmq',
			          occupation: ':shrug:'
			        }
			    ]
			}
		},
		methods: {
			fileReader(oEvent){
		        var oFile = oEvent.target.files[0];
		        var sFilename = oFile.name;

		        var reader = new FileReader();
		        var result = {};

		        reader.onload = function (e) {
		            var data = e.target.result;
		            data = new Uint8Array(data);
		            var workbook = XLSX.read(data, {type: 'array'});
		            console.log(workbook);
		            var result = {};
		            workbook.SheetNames.forEach(function (sheetName) {
		                var roa = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {header: 1});
		                if (roa.length) result[sheetName] = roa;
		            });
		            // see the result, caution: it works after reader event is done.
		            console.log(result);
		        };
		        reader.readAsArrayBuffer(oFile);				
			},
			exportExcel() {
		      let data = XLSX.utils.json_to_sheet(this.dataToExport)
		      const workbook = XLSX.utils.book_new()
		      const filename = 'devschile-admins'
		      XLSX.utils.book_append_sheet(workbook, data, filename)
		      XLSX.writeFile(workbook, `${filename}.xlsx`)
		    }
		}
	};
</script>