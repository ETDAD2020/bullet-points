import React, { useState } from "react"
import { AppProvider } from "@shopify/polaris"
import { usePage } from "@inertiajs/inertia-react"
import { Provider, Toast } from "@shopify/app-bridge-react"
import enTranslations from "@shopify/polaris/locales/en.json"

export default function AppLayout({ children }) {
    const config = {
        apiKey: document.getElementById("apiKey").value,
        shopOrigin: document.getElementById("shopOrigin").value,
        forceRedirect: true
    };

    return (
        <AppProvider i18n={enTranslations}>
            <Provider config={config}>
                {children}
            </Provider>
        </AppProvider>
    );
}
