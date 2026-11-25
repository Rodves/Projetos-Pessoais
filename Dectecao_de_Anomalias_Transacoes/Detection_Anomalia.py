import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split, GridSearchCV
from sklearn.pipeline import Pipeline
from sklearn.linear_model import LogisticRegression
from sklearn.preprocessing import StandardScaler
from sklearn.metrics import classification_report
from sklearn.ensemble import RandomForestClassifier
from xgboost import XGBClassifier
from sklearn.metrics import roc_auc_score
import matplotlib.pyplot as plt
import os
import shap

url = "https://storage.googleapis.com/download.tensorflow.org/data/creditcard.csv"

df = pd.read_csv(url)
#print(df["Class"].value_counts(normalize=True))

os.system('cls')

df['Amount_log'] = np.log1p(df["Amount"])

x = df.drop("Class", axis=1)
y = df["Class"]

X_train, X_test, y_train, y_test = train_test_split(
    x, y, stratify=y, test_size=0.3, random_state=42 
)


def avaliar_modelo(nome, y_true, y_pred,y_prob, threshold=0.5):
    y_threshold = (y_prob >= threshold).astype(int)

    print(f"\n=== {nome} (limiar {threshold}) ===")
    print("ROC-AUC:", round(roc_auc_score(y_true, y_prob), 4))
    print("Limiar modificado",classification_report(y_true, y_threshold))
    print("Limiar padrão",classification_report(y_true, y_pred))

def comparar_modelos(resultados, top=10):
    """
    Compara a importância das variáveis entre os modelos.
    Cada modelo usa uma unidade diferente de SHAP (log-odds, probabilidade...),
    então cada importância é convertida em proporção do total do próprio modelo.
    """
    imp = pd.DataFrame(
        {nome: np.abs(sv.values).mean(axis=0) for nome, sv in resultados.items()},
        index=X_test.columns,
    )
    imp = imp / imp.sum()
    

    top_features = imp.mean(axis=1).sort_values(ascending=False).head(top).index
    tabela = imp.loc[top_features]

    print("\n=== Importância relativa das variáveis por modelo (% do total) ===")
    print((tabela * 100).round(2))

    for nome, sv in resultados.items():
        shap.plots.bar(
        nome,
        sv,
        max_display=top
    )

X_sample = X_test[:100]
X_background = X_train.sample(200, random_state=42)
resultados_shap = {}    

def shap_regressao_logistica(pipe, X_background, X_sample):
    """Pipeline: explica só o LogisticRegression, usando os dados já escalados pelo StandardScaler."""
    scaler = pipe.named_steps["scaler"]
    lr = pipe.named_steps["model"]

    bg = pd.DataFrame(scaler.transform(X_background), columns=X_background.columns)
    amostra = pd.DataFrame(scaler.transform(X_sample), columns=X_sample.columns)

    explainer = shap.Explainer(lr, bg)
    return explainer(amostra)

def shap_arvore(model, X_sample):
    """Random Forest e XGBoost: o shap.Explainer escolhe o TreeExplainer sozinho."""
    explainer = shap.Explainer(model)
    shap_values = explainer(X_sample)

    if shap_values.values.ndim == 3:
        shap_values = shap_values[..., 1]
    return shap_values


def plotar_shap(name, values):

    shap.plots.bar(
        values,
        max_display=15,
        show=False
    )

    plt.title(f"{name} - Importância das Variáveis")
    plt.tight_layout()
    plt.show()

#Logic Regression
model = Pipeline([
    ("scaler", StandardScaler()),
    ("model", LogisticRegression(max_iter=1000, random_state=42))
])

model.fit(X_train, y_train)
y_pred = model.predict(X_test)
y_prob = model.predict_proba(X_test)[:,1]

""" avaliar_modelo("Regressao Logistica", y_test, y_pred, y_prob, threshold=0.3)

shap_lr = shap_regressao_logistica(model, X_background, X_sample)
resultados_shap["Logic Regression"] = shap_lr
shap.plots.bar(shap_lr, max_display=10) """

print("\n")

#RANDOMFOREST
rf = Pipeline([
    ("rf", RandomForestClassifier(n_estimators=50,  max_depth=10,  
        class_weight="balanced", n_jobs=-1,
        random_state=42))
])

rf.fit(X_train, y_train)

y_pred_rf = rf.predict(X_test)
y_prob_rf = rf.predict_proba(X_test)[:,1]

avaliar_modelo("Random Forest", y_test, y_pred_rf, y_prob_rf, threshold=0.3)

shap_rf = shap_arvore(rf.named_steps["rf"], X_sample)
plotar_shap("Random Forest", shap_rf)
resultados_shap["Random Forest"] = shap_rf
print("\n")

#XGBOOST
xgb = XGBClassifier(
    scale_pos_weight=10, 
    eval_metric="logloss"
)

xgb.fit(X_train, y_train)
y_pred_xgb = xgb.predict(X_test)
y_prob_xgb = xgb.predict_proba(X_test)[:,1]

avaliar_modelo("XGBooster", y_test, y_pred_xgb, y_prob_xgb, threshold=0.3)

shap_xgb = shap_arvore(xgb, X_sample)
resultados_shap["XGBoost"] = shap_xgb
plotar_shap("XGBoost", shap_xgb)

print("\n")

comparar_modelos(resultados_shap,top=10)

param_grid = {
    "max_depth": [3, 5],
    "n_estimators": [50, 100]
}

""" grid = GridSearchCV(
    XGBClassifier(eval_metric="logloss"),
    param_grid,
    scoring="recall",  
)

grid.fit(X_train, y_train)
print("Melhor modelo", grid.best_params_)
 """