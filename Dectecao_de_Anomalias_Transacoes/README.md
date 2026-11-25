# 🛡️ Detecção de Anomalias em Transações Financeiras com Machine Learning

Projeto desenvolvido como parte do Lab **"Detecção de Anomalias em Transações"** na trilha **Santander: Dados com Python e IA** da [DIO](https://dio.me).

---

## 📌 Visão Geral do Projeto

A detecção de fraudes em transações financeiras é um problema clássico e desafiador em Ciência de Dados, caracterizado pelo **severo desbalanceamento de classes**: transações fraudulentas representam uma parcela ínfima (menos de 0,2%) do total transacionado.

Neste projeto, desenvolveu-se um pipeline analítico em Python para:
1. **Tratamento de Dados**: Pré-processamento e transformação logarítmica da variável financeira de valor (`Amount`).
2. **Modelagem Supervisionada**: Treinamento e comparação de modelos preditivos (**Regressão Logística**, **Random Forest** e **XGBoost**).
3. **Tratamento de Classes Desbalanceadas**: Aplicação de pesos de classe (`class_weight`, `scale_pos_weight`) e **calibração de limiar de decisão (*threshold tuning*)**.
4. **Avaliação Focada em Negócio**: Uso de métricas adequadas a dados desbalanceados (Precision, Recall, F1-Score e ROC-AUC).
5. **Explicabilidade (XAI)**: Interpretação e comparação da importância de atributos através de valores **SHAP (SHapley Additive exPlanations)**.

---

## 📊 Dataset

- **Fonte**: [Credit Card Fraud Detection Dataset](https://storage.googleapis.com/download.tensorflow.org/data/creditcard.csv) (TensorFlow Datasets / Kaggle).
- **Características**:
  - Total de transações: ~284.807, com apenas 492 fraudes (aproximadamente **~0,172%** da classe positiva).
  - Variáveis $V_1$ a $V_{28}$: componentes principais obtidos via PCA para preservação de confidencialidade dos dados bancários.
  - Variáveis não transformadas: `Time` (tempo decorrido em segundos) e `Amount` (valor da transação).

---

## 🛠️ Tecnologias e Bibliotecas

- **Linguagem**: Python 3.9+
- **Manipulação de Dados**: `pandas`, `numpy`
- **Machine Learning**: `scikit-learn`, `xgboost`
- **Explicabilidade (XAI)**: `shap`
- **Visualização Gráfica**: `matplotlib`

---

## ⚙️ Arquitetura do Pipeline

```
├── 1. Coleta & Pré-processamento
│   ├── Ingestão do dataset de transações de cartão de crédito
│   ├── Transformação logarítmica (log1p) no atributo 'Amount'
│   └── Separação estratificada (train_test_split com stratify=y)
│
├── 2. Modelagem & Treinamento
│   ├── Regressão Logística com StandardScaler via Pipeline
│   ├── Random Forest com class_weight='balanced'
│   └── XGBoost com scale_pos_weight=10
│
├── 3. Avaliação & Ajuste de Threshold
│   ├── Cálculo da métrica ROC-AUC
│   ├── Comparativo entre Limiar Padrão (0.5) vs Limiar Otimizado (0.3)
│   └── Foco no compromisso entre Precision e Recall
│
└── 4. Explicabilidade (XAI)
    ├── Explicações locais e globais via SHAP (LinearExplainer & TreeExplainer)
    └── Comparação da importância relativa das features entre modelos
```

---

## 📈 Principais Conclusões e Decisões de Modelagem

### 1. Calibração do Limiar de Decisão (*Threshold*)
Em cenários de combate a fraudes bancárias, o custo de um **Falso Negativo** (não detectar uma fraude) é substancialmente superior ao de um **Falso Positivo** (bloquear ou solicitar confirmação em uma transação legítima).
- Ao reduzir o ponto de corte de decisão probabilística de `0.5` para `0.3`, aumentou-se o **Recall** da classe minoritária, elevando a taxa de detecção de fraudes sem perda excessiva de precisão.

### 2. Interpretabilidade com SHAP
Modelos baseados em ensemble de árvores frequentemente atuam como "caixas-pretas". Com a utilização da teoria dos jogos cooperativos via **SHAP**:
- Identificou-se a contribuição marginal de cada feature para o risco de fraude.
- Viabilizou-se a auditoria do modelo e a geração de explicações claras para tomada de decisão em áreas de risco e compliance.

---

## 🚀 Como Executar o Projeto

### 1. Clonar o Repositório
```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

### 2. Configurar o Ambiente Virtual
```bash
# Criar ambiente virtual
python -m venv .venv

# Ativar no Windows:
.venv\Scripts\activate

# Ativar no Linux / macOS:
source .venv/bin/activate
```

### 3. Instalar Dependências
```bash
pip install pandas numpy scikit-learn xgboost shap matplotlib
```

*(Opcional: se preferir, gere um arquivo `requirements.txt` com `pip freeze > requirements.txt`)*

### 4. Executar o Script
```bash
python main.py
```

---

## 🤝 Autor e Referências

- Desenvolvido por **Rodrigo**.
- Projeto prático integrado à formação **Santander: Dados com Python e IA** oferecida pela [DIO](https://dio.me).
