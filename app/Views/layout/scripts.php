<script>
    // نستخدم دالة jQuery القياسية لضمان أن كل شيء جاهز قبل تنفيذ الكود
    $(document).ready(function() {
        
        // 1. تفعيل Select2 على كل القوائم المنسدلة في الصفحة
        $('.form-select').select2({
            theme: 'bootstrap-5'
        });

        // 2. منطق النوافذ المنبثقة (Modal) مع دعم Select2
        $('#main-modal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            if (!button.length) return;
            var url = button.attr('href');
            var modalContent = $(this).find('.modal-content');
            modalContent.html('<div class="modal-body text-center p-4"><div class="spinner-border"></div></div>');
            
            modalContent.load(url, function(response, status) {
                if (status == "error") {
                    modalContent.html('<div class="modal-body"><div class="alert alert-danger">فشل تحميل المحتوى.</div></div>');
                    return;
                }
                // نعيد تفعيل Select2 على القوائم داخل النافذة المنبثقة
                modalContent.find('.form-select').select2({
                    theme: 'bootstrap-5',
                    dropdownParent: $('#main-modal')
                });
            });
        });

        $('#main-modal').on('hidden.bs.modal', function(){
            $(this).find('.modal-content').html('');
        });

        // 3. منطق رسائل تأكيد الحذف
        $('body').on('click', '.confirm-delete', function(e) {
            e.preventDefault();
            const button = $(this);
            const url = button.attr('href');
            const csrfToken = button.data('csrf-token');
            Swal.fire({
                title: 'هل أنت متأكد؟', text: "لن تتمكن من التراجع عن هذا!", icon: 'warning',
                showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، قم بالحذف!', cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $('<form>', { 'method': 'POST', 'action': url });
                    var csrfInput = $('<input>', { 'type': 'hidden', 'name': '<?= csrf_token() ?>', 'value': csrfToken });
                    form.append(csrfInput).appendTo('body').submit();
                }
            });
        });

        // 4. منطق تحديد عدد السجلات في الصفحة
        $('#per-page-select').on('change', function() {
            const perPage = this.value;
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('perPage', perPage);
            currentUrl.searchParams.delete('page');
            window.location.href = currentUrl.toString();
        });

        // 5. تفعيل Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });

    // دالة مركزية لتحديد كل مربعات الاختيار
    function toggleAllCheckboxes(source) {
        document.querySelectorAll('input[name="row_id[]"]').forEach(checkbox => {
            checkbox.checked = source.checked;
        });
    };
</script>