import React, {useState, useCallback, useEffect} from 'react'
import AppLayout from "../Shared/AppLayout"
import {Inertia} from '@inertiajs/inertia'
import {
    Page,
    Layout,
    Card,
    DisplayText,
    Banner,
    DataTable,
    RadioButton,
    Stack,
    Checkbox
} from "@shopify/polaris";
import { TitleBar, Toast } from "@shopify/app-bridge-react";
import { values } from 'lodash';
import { event } from 'jquery';

const Home = (orders_list)=> {
    console.log(orders_list);
    const [checked, setChecked] = useState(orders_list.app_settings[0].product_page ? true : false);
    const [checked1, setChecked1] = useState(orders_list.app_settings[0].cart_page ? true : false);
    const [value, setValue] = useState(orders_list.app_settings[0].notification_type);

    const mystyle = {
        width: "164px"
      };

    const mystyle2 = {
        margin: "2% 36% 2%"
      };

    const [active, setActive] = useState(false);
    const toggleActive = useCallback(() => setActive((active) => !active), []);
    const toastMarkup = active ? (
        <Toast content="App Settings Updated" onDismiss={toggleActive} />
      ) : null;

    function handleChange(e){
        setChecked(e);
        toggleActive();
        const formData = new FormData();
        formData.append('product', e);
        Inertia.post('https://app.storeks.com/app-setting-product', formData);
    }

    function handleChange1(e){
        setChecked1(e);
        toggleActive();
        const formData = new FormData();
        formData.append('cart', e);
        Inertia.post('https://app.storeks.com/app-setting-cart', formData);
    }


    function handleChangeRadio(_checked, newValue)
    {
        setValue(newValue);
        console.log(newValue);
        toggleActive();
        const formData = new FormData();
        formData.append('notification_type', newValue);
        Inertia.post('https://app.storeks.com/set-notification', formData);

    }

    return (
        <AppLayout>
        <TitleBar title="Dashboard" />
        <Page>
            <Layout>
                <Layout.Section>
                    <div className="Polaris-TopBar__LogoContainer" style={mystyle2}><a className="Polaris-TopBar__LogoLink" href="http://storeks.com/" data-polaris-unstyled="true" style={mystyle}><img src="https://app.storeks.com/image/StoreksLogo.png" alt="Jaded Pixel" className="Polaris-TopBar__Logo" style={mystyle} /></a></div>
                    <Card title="Show Add Insurance Button" sectioned>
                        <p>Please check the option below to show the add insurance option on the pages</p>
                        <Checkbox label="Show on Product Page" id="product-page" value="product" checked={checked} onChange={handleChange} />
                        <br />
                        <Checkbox label="Show on Cart Page" id="cart-page" value="cart" checked={checked1} onChange={handleChange1} />
                    </Card>
                </Layout.Section>

                <Layout.Section>
                    <Card title="Insurance Button Type" sectioned>
                        <p>Check the option below to select the style of Insurance button appearance</p>
                        <Stack vertical>
                            <RadioButton
                                label="Button Type"
                                helpText="It will show the floating button"
                                checked={value === 'button_type'}
                                id="button_type"
                                name="style_type"
                                onChange={handleChangeRadio}
                            />
                            <RadioButton
                                label="Popup Type"
                                helpText="It will show the popup after add-to-cart button click"
                                id="popup_type"
                                name="style_type"
                                checked={value === "popup_type"}
                                onChange={handleChangeRadio}
                            />
                        </Stack>
                    </Card>
                </Layout.Section>
                <Layout.Section>
                        <Card>
                        <div className="Polaris-Page__Content">
                            <div className="Polaris-Card">
                                <div className="">
                                    <div className="Polaris-DataTable__Navigation"><button type="button" className="Polaris-Button Polaris-Button--disabled Polaris-Button--plain Polaris-Button--iconOnly" disabled="" aria-label="Scroll table left one column"><span className="Polaris-Button__Content"><span className="Polaris-Button__Icon"><span className="Polaris-Icon"><svg viewBox="0 0 20 20" className="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16z"></path>
                                    </svg></span></span></span></button><button type="button" className="Polaris-Button Polaris-Button--plain Polaris-Button--iconOnly" aria-label="Scroll table right one column"><span className="Polaris-Button__Content"><span className="Polaris-Button__Icon"><span className="Polaris-Icon"><svg viewBox="0 0 20 20" className="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <path d="M8 16a.999.999 0 0 1-.707-1.707L11.586 10 7.293 5.707a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5A.997.997 0 0 1 8 16z"></path>
                                    </svg></span></span></span></button></div>
                                    <div className="Polaris-DataTable">
                                        <div className="Polaris-DataTable__ScrollContainer">
                                            <table className="Polaris-DataTable__Table">
                                                <thead>
                                                <tr>
                                                    <th data-polaris-header-cell="true" className="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Order Id</th>
                                                    <th data-polaris-header-cell="true" className="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Product Id</th>
                                                    <th data-polaris-header-cell="true" className="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Price</th>
                                                    <th data-polaris-header-cell="true" className="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    {orders_list.orders_list.map(orders =>
                                                        <tr className="Polaris-DataTable__TableRow">
                                                            <th className="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">{orders.order_id}</th>
                                                            <th className="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">{orders.product_id}</th>
                                                            <th className="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">{orders.price}</th>
                                                            <th className="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">{orders.status}</th>
                                                        </tr>
                                                    )}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </Card>
                </Layout.Section>
            </Layout>
            {toastMarkup}
        </Page>
    </AppLayout>
    )
}

export default Home
