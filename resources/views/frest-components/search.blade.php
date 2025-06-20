<div class="users-list-filter px-1">
    <form>
        <div class="row border rounded py-2 mb-2">
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="users-list-verified">تایید شده</label>
                <fieldset class="form-group">
                    <select class="form-control" id="users-list-verified">
                        <option value="">همه</option>
                        <option value="بله">بله</option>
                        <option value="خیر">خیر</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="users-list-role">نقش</label>
                <fieldset class="form-group">
                    <select class="form-control" id="users-list-role">
                        <option value="">همه</option>
                        <option value="کاربر">کاربر</option>
                        <option value="کارمند">کارمند</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <label for="users-list-status">وضعیت</label>
                <fieldset class="form-group">
                    <select class="form-control" id="users-list-status">
                        <option value="">همه</option>
                        <option value="فعال">فعال</option>
                        <option value="بسته شده">بسته شده</option>
                        <option value="مسدود شده">مسدود شده</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                <button type="reset" class="btn btn-success btn-block glow users-list-clear mb-0 mt-75">جستجو</button>
                <button type="reset" class="btn btn-primary btn-block glow users-list-clear mb-0 mt-75">پاکسازی</button>
            </div>
        </div>
    </form>
</div>
